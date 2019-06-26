<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\ContainerType;
use App\ExtraService;
use App\GoodType;
use App\Mail\ApprovalRequest;
use App\Mail\ProjectInvoice;
use App\Mail\QuotationUpdate;
use App\Quotation;
use App\QuotationService;
use App\ServiceTax;
use App\Tariff;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Esl\Repository\UploadFileRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Zend\Diactoros\Response;

class QuotationController extends Controller
{
    public function showQuotation($id)
    {
        $quote = Quotation::with([
            'lead', 'parties', 'cargos.goodType', 'cargos.consignee',
            'vessel', 'voyage', 'services.tariff', 'remarks.user', 'services' => function ($query) {
                $query->where('type', 'pda');
            }
        ])->findOrFail($id);

        if ($quote->service_type_id != null) {

            return view('quotation.other-service')
                ->withQuotation($quote)
                ->withTaxs(ServiceTax::all()->sortBy('Description'))
                ->withServices(ExtraService::all()->sortBy('name'));
        }


        return view('quotation.show')
            ->withQuotation($quote)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withGoodtypes(GoodType::all())
            ->withContainertypes(ContainerType::all())
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function requestQuotation($id)
    {
        Quotation::findOrFail($id)->update(['status' => Constants::LEAD_QUOTATION_REQUEST]);

        NotificationRepo::create()->notification(
            Constants::Q_APPROVAL_TITLE,
            Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/' . $id,
            0,
            Constants::DEPARTMENT_AGENCY
        )
            ->success('Approval send successfully');


        Mail::to(['email' => 'accounts@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new ProjectInvoice(['message' => 'Kindly review this quotation (' . ' ' . url('/quotation/preview/' . $id) . ' ' . ')and advice Head of Agency in case the project is making loss otherwise ignore'], 'Client Quotation Review'));

        Mail::to(['email' => 'francis.opalo@esl-eastafrica.com'])
//            ->cc(['evans@esl-eastafrica.com'])
            ->send(new ApprovalRequest([
                'user' => Auth::user()->name,
                'url' => '/quotation/view/' . $id
            ], 'Approval Request'));

        return redirect()->back();
    }

    public function viewQuotation($id)
    {
        $quote = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff', 'remarks.user', 'services' => function ($query) {
            $query->where('type', 'pda');
        }])->findOrFail($id);

        if ($quote->service_type_id != null) {
            return view('quotation.other-service-view')
                ->withQuotation($quote)
                ->withTaxs(ServiceTax::all()->sortBy('Description'))
                ->withServices(ExtraService::all()->sortBy('name'));
        }

        return view('quotation.view')
            ->withQuotation($quote)
            ->withGoodtypes(GoodType::all())
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function previewQuotation($id)
    {
        $quote = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff', 'remarks.user', 'services' => function ($query) {
            $query->where('type', 'pda');
        }])->findOrFail($id);

        if ($quote->service_type_id != null) {
            return view('quotation.other-preview')
                ->withQuotation($quote);
        }

        return view('quotation.preview')
            ->withQuotation($quote);
    }


    public function downloadQuotation($id)
    {
        $quotation = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff', 'remarks.user', 'services' => function ($query) {
            $query->where('type', 'pda');
        }])->findOrFail($id);

        if ($quotation->service_type_id != null) {
            return view('quotation.other-preview')
                ->withQuotation($quotation);
        }
//
        $pdf = PDF::loadView('pdf.invoice', compact('quotation'));
        return $pdf->download($quotation->lead->name . '_invoice.pdf');

//        return view('pdf.invoice')
//            ->withQuotation($quotation);
    }

    public function sendToCustomer(Request $request)
    {
        $quote = Quotation::with([
            'lead', 'parties', 'cargos.goodType', 'consignee',
            'vessel', 'voyage', 'services.tariff', 'remarks.user'
        ])->findOrFail($request->quotation_id);

        QuotationRepo::make()->changeStatus(
            $request->quotation_id,
            Constants::LEAD_QUOTATION_WAITING
        );

        $ifnull = Quotation::with(['parties'])->findOrFail($request->quotation_id)->parties;

        if ($ifnull) {
            $parties = json_decode(Quotation::with(['parties'])->findOrFail($request->quotation_id)->parties->emails);

            foreach ($parties as $party) {
                Mail::to(['email' => trim($party, ' ')])
                    ->send(new \App\Mail\Quotation([
                        'message' => $request->message,
                        'user' => Auth::user()->name,
                        'url' => '/quotation/preview/' . $request->quotation_id,
                        'download' => '/quotation/download/' . $request->quotation_id
                    ], $request->subject));
            }
        }


        Mail::to(['email' => $request->email])
            ->send(new \App\Mail\Quotation([
                'message' => $request->message,
                'user' => Auth::user()->name,
                'url' => '/quotation/preview/' . $request->quotation_id,
                'download' => '/quotation/download/' . $request->quotation_id
            ], $request->subject));
//                'url'=>'/quotation/preview/'.$request->quotation_id],$request->subject,['address'=>$user->email]));

        NotificationRepo::create()->success('PDA send to client successfully');

        return redirect()->back();
    }

    public function pdfQuotation($id)
    {
        $quotation = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff'])->findOrFail($id);

        $pdf = PDF::loadView('quotation.pdf', compact('quotation'));
        return $pdf->download('pda.pdf');


    }

    public function customerAccept($id)
    {

        $available = BillOfLanding::where('quote_id', $id)->get()->first();
       // dd($available);
        if ($available) {
            QuotationRepo::make()->changeStatus(
                $id,
                Constants::LEAD_QUOTATION_CONVERTED
            );
        } else {
            QuotationRepo::make()->changeStatus(
                $id,
                Constants::LEAD_QUOTATION_ACCEPTED
            );
        }

        $userEmail = User::findOrFail(Quotation::findOrFail($id)->user_id)->email;

        Mail::to([$userEmail])
            ->send(new QuotationUpdate([
                'url' => '/quotation/' . $id,
                'message' => 'Your quotation has been accepted by the client'
            ], 'noreply@esl-eastafrica.com'));

        NotificationRepo::create()->success('PDA accepted');
        return redirect()->back();
    }

    public function pdaStatus($status)
    {
        if ($status == Constants::LEAD_QUOTATION_PENDING) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where(
                'status',
                Constants::LEAD_QUOTATION_PENDING
            )->get();
        }

        if ($status == Constants::LEAD_QUOTATION_REQUEST) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where(
                'status',
                Constants::LEAD_QUOTATION_REQUEST
            )->get();
        }

        if ($status == Constants::LEAD_QUOTATION_APPROVED) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where(
                'status',
                Constants::LEAD_QUOTATION_APPROVED
            )->get();
        }

        return view('pdas.index')
            ->withDms($dms)
            ->withStatus($status);

    }

    public function customerDecline($id)
    {
        QuotationRepo::make()->changeStatus(
            $id,
            Constants::LEAD_QUOTATION_DECLINED_CUSTOMER
        );

        $userEmail = User::findOrFail(Quotation::findOrFail($id)->user_id)->email;

        Mail::to([$userEmail])
            ->send(new QuotationUpdate([
                'url' => '/quotation/' . $id,
                'message' => 'Your quotation has been declined by the client'
            ], 'noreply@esl-eastafrica.com'));

        NotificationRepo::create()->success('PDA declined');

        return redirect()->back();
    }

    public function convertCustomer(Request $request, $id)
    {
        $quotation = Quotation::with([
            'user', 'consignee', 'lead', 'parties', 'cargos.goodType',
            'vessel', 'voyage', 'services.tariff', 'remarks.user'
        ])->findOrFail($id);

        if ($quotation->service_type_id == null) {
            if ($quotation->voyage == null) {
                NotificationRepo::create()->error('No Voyage details added');
                return redirect()->back();
            }

            if (count($quotation->services) < 1) {
                NotificationRepo::create()->error('No Services added');
                return redirect()->back();
            }

            if (count($quotation->cargos) < 1) {
                NotificationRepo::create()->error('No Cargo/Consignee added');
                return redirect()->back();
            }
        }

        QuotationRepo::make()->changeStatus(
            $id,
            Constants::LEAD_QUOTATION_CONVERTED
        );

        NotificationRepo::create()->notification(
            Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/' . $id,
            0,
            'Agency',
            Auth::user()->id
        )
            ->success('Job started successfully');
//TODO:CRE
        $leadData = $quotation->lead;
//        dd($leadData);
        $customer = CustomersRepo::customerInit()->convertLeadToCustomer($leadData->toArray());

//        dd(isset());
        $bl = BillOfLanding::create([
            'vessel_id' => $quotation->vessel_id,
            'quote_id' => $quotation->id,
            'service_type_id' => $quotation->service_type_id != null ? $quotation->service_type_id : null,
            'voyage_id' => $quotation->service_type_id != null ? 0 : $quotation->id,
//            'consignee_id' => $quotation->service_type_id != null ? 0 : $quotation->consignee->id,
            'Client_id' => isset($customer['client_id']) ? $customer['DCLink'] : $customer->DCLink,
            'laytime_start' => Carbon::now(),
            'time_allowed' => 0,
//            'cargo_id' => $quotation->cargos->first()->id,
            'cargo_id' => 0,
            'stage' => 'Pre-arrival docs',
            'status' => 0,
            'sof_status' => 0,
            'bl_number' => '',
        ]);

        return redirect('/dms/edit/' . $bl->id);
    }

    public function myPdas()
    {
        return view('quotation.pdas')
            ->withPdas(Quotation::with([
                'lead', 'parties', 'cargos.goodType', 'consignee',
                'vessel', 'voyage', 'services.tariff', 'remarks.user'
            ])->where('user_id', Auth::user()->id)->get()
                ->sortBy('created_at'));
    }

    public function allPdas()
    {
        return view('quotation.pdas')
            ->withPdas(Quotation::with([
                'lead', 'parties', 'cargos.goodType', 'consignee',
                'vessel', 'voyage', 'services.tariff', 'remarks.user'
            ])->get()
                ->sortBy('created_at'));
    }

    public function addRemittance(Request $request)
    {
        $quote = Quotation::findOrFail($request->quotation_id);

        $remittance = $quote->remittance + $request->amount;
        $quote->update(['remittance' => $remittance]);
        NotificationRepo::create()->success('Remittance subtracted  successfully');
        return Response(['success' => 'success']);
    }

    public function reduceRemittance(Request $request)
    {
        $quote = Quotation::findOrFail($request->quotation_id);

        if ($request->amount > $quote->remittance) {

            NotificationRepo::create()->error('Amount is more than the available remittance amount');
            return Response(['success' => 'success']);
        }

        $remittance = $quote->remittance - $request->amount;
        $quote->update(['remittance' => $remittance]);

        NotificationRepo::create()->success('Remittance subtracted  successfully');

        return Response(['success' => 'success']);
    }


    public function serviceCost(Request $request)
    {
        $filepath = ' ';
        if ($request->has('doc_path')) {
            $filepath = UploadFileRepo::init()->upload($request->doc_path);
        }

        $service = QuotationService::find($request->service_id);
        $service->buying_price = $request->buying_price;
        $service->purchase_desc = $request->description;
        $service->doc_path = $filepath;
        $service->save();

        // toast('Service cost add successfully');

        return redirect()->back();
    }

    public function updateRemmitance()
    {

        Quotation::findOrFail(request()->get('quote_id'))->update(['remittance' =>request()->get('remittance')]);
        return response()->json(['success'=>'Updated Successfully']);
    }
}
