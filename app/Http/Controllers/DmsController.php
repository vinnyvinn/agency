<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\BillHeader;
use App\BillOfLanding;
use App\Cargo;
use App\CashRequest;
use App\DmsComponent;
use App\Mail\ProjectInvoice;
use App\PettyCash;
use App\Proforma;
use App\Quotation;
use App\Sof;
use App\Stage;
use App\StkItem;
use App\Vessel;
use App\VoucherType;
use App\Voyage;
use App\Project;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Esl\helpers\Constants;
use Esl\Repository\InvNumRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\ProjectRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\InvNum;
use DB;

class DmsController extends Controller
{
    public function index()
    {
        $bl = BillOfLanding::with(['vessel','quote.services','quote.cargos','customer'])
            ->get();
          // dd(\Carbon\Carbon::createFromFormat('H:i:s','17:45')->format('h:i'));
        return view('dms.index')
            ->withDms($bl);
    }

    public function edit($id)
         {

        $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
            'quote.voyage','customer','quote.cargos.consignee','quote.logs','quote.pettyCash'])->findOrFail($id);

         //dd($dms->quote);
        $dmsComponents = DmsComponent::with(['scomponent.stage'])->where('bill_of_landing_id',$id)->get();
        
        $checklist = $dmsComponents->map(function ($value) {
//            dd($value);
            return [
                'title' => $value->scomponent->stage->name,
                $value->scomponent->stage->name => [
                    'name' => $value->scomponent->name,
                    'type' => $value->scomponent->type,
                    'doc_links' => json_decode($value->doc_links),
                    'text' => $value->text,
                    'subchecklist' => $value->subchecklist,
                    'created_at' => $value->created_at
                ]
            ];
        })->reject(null);
        $update = false;
        if ($dms->seal_number == null || $dms->berth_number == null || $dms->place_of_receipt == null || $dms->date_of_loading == null ||
            $dms->number_of_crane == null ){
            $update = true;
        }

        $stageids = [];
        $demo = DmsComponent::with(['scomponent'])->where('bill_of_landing_id',$id)
            ->get(['stage_component_id']);
        foreach ($demo as $value){
            if (!in_array($value->scomponent->id, $stageids)){
                array_push($stageids,$value->scomponent->stage_id);
            }
        }

        if ($dms->service_type_id != null){
            $update = false;
            if ($dms->code_name == null || $dms->seal_number == null || $dms->berth_number == null){
                $update = true;
            }
            return view('dms.other-edit')
                ->withDms($dms)
                ->withStageids($stageids)
                ->withChecklist($checklist->groupBy('title'))
                ->withUpdate($update)
                ->withStages(Stage::with(['components'])->where('service',$dms->service_type_id)->get());
        }
//dd($stageids);
        return view('dms.edit')
            ->withDms($dms)
            ->withStageids($stageids)
            ->withProjects(Project::all())
            ->withChecklist($checklist->groupBy('title'))
            ->withUpdate($update)->with('payment_types',VoucherType::where('fk_iVoucherMaster',1)->get())
            ->withStages(Stage::with(['components'])->where('job_type_id',$dms->quote->job_type_id)->get());
//            ->withStages(Stage::with(['components'])->where('service',0)->get());
    }

    public function viewQoute($id)
    {
     $quotes = PettyCash::where('id',$id)->first();
     return view('dms.quote-view')->with('quote',$quotes);
    }

    public function store(Request $request)
    {

        $data = [];

        if ($request->has('checklist')){

            foreach ($request->checklist as $key => $check){
                $checklist = [];
                foreach ($check as $inner_key => $item){
                    array_push($checklist,$inner_key);
                }
                array_push($data,[$key => ['components'=>json_encode($checklist)]]);
            }

        }

        if ($request->has('text_value')){

            foreach ($request->text_value as $key => $item){
                array_push($data,[$key => ['text' => $item[0]]]);
            }
        }

        if ($request->has('doc_links')){
            foreach ($request->doc_links as $key => $doc_link){
                $doc_array = [];
                foreach ($doc_link as $doc){
                    $image = $doc;
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $filepath = 'documents/uploads/';

                    $image->move(public_path('documents/uploads/'),$name);
                    array_push($doc_array,$filepath.$name);
                }


                array_push($data,[$key => ['doc_links' => json_encode($doc_array)]]);

            }
        }

        $keys = [];

        $insertData = [];
        $now = Carbon::now();
        foreach ($data as $key => $datum){
            foreach ($datum as $data_key => $value){
                foreach ($value as $xkey => $inner){
                    if (!array_key_exists($data_key,$keys)){
                        array_push($insertData,[
                            'bill_of_landing_id' => $request->dms_id,
                            'stage_component_id' => $data_key,
                            'doc_links' => $xkey == "doc_links" ? $inner : null,
                            'text' => $xkey == "text" ? $inner : null,
                            'subchecklist' => $xkey == "components" ? $inner : null,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                        $keys[$data_key] = $data_key;
                    }
                    else{
                        foreach ($insertData as $skey => $test){
                            array_push($insertData,[
                                'bill_of_landing_id' => $request->dms_id,
                                'stage_component_id' => $data_key,
                                'doc_links' => ($xkey == "doc_links" && $test['doc_links'] == null) ? $inner : $test['doc_links'],
                                'text' => ($xkey == "text"  && $test['text'] == null) ? $inner : $test['text'],
                                'subchecklist' => ($test['subchecklist'] == null && $xkey == "components") ? $inner : $test['subchecklist'],
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);

                            unset($insertData[$skey]);
                            break;
                        }
                    }

                }
            }
        }

        DmsComponent::insert($insertData);

        NotificationRepo::create()->success('DSR updated successfully');
        return redirect()->back();
    }

    public function deleteSof($id)
    {
        Sof::findOrFail($id)->delete();

        NotificationRepo::create()->success('Deleted successfully');

        return redirect()->back();
    }

    public function addSof(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $data['from'] = Carbon::parse($request->from.' '.$request->from_time);
        $data['to'] = Carbon::parse($request->to.' '.$request->to_time);

        if (Carbon::parse($request->from.' '.$request->from_time)->gt(Carbon::parse($request->to.' '.$request->to_time))){
//            NotificationRepo::create()->error('From date cannot be greater than To date');
            return Response(['success' => 'error','error'=>'From date cannot be greater than To date']);
        }

        if ($request->total_cranes < $request->crane_working){
//            NotificationRepo::create()->error('');
            return Response(['success' => 'error','error'=>'Working cranes cannot be more than Total cranes']);
        }

        if ($request->has('sof_id')){
            Sof::findOrFail($request->sof_id)->update($data);
        }
        else{
            Sof::create($data);
        }

        NotificationRepo::create()->success('SOF Updated');

        return Response(['success' => 'success']);
    }

    public function complete($id)
    {
      $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
            'quote.voyage','customer','quote.cargos.consignee','quote.logs'])->findOrFail($id);
        $date = Carbon::now()->format('yy-m-d');


        if ($dms->quote->status != Constants::LEAD_QUOTATION_CONVERTED){

            NotificationRepo::create()->error('Complete the PDA before completing this project');
            redirect()->back();
        }
        foreach ($dms->quote->cargos as $cargo){
            if ($cargo->consignee != null){
                $proforma = Proforma::with(['services','customer'])->where('consignee_id',$cargo->consignee->id)->get();
//
            }
        }

        //InvNumRepo::init()->makeInvoice($dms,$proforma ? $proforma->first() : '');
        $quotation = Quotation::findOrFail($dms->quote_id);

        $bill_header = BillHeader::create([
            'QUOTE_NO' => $dms->quote->crm_ref,
            'OPERATION_APP' =>  env('DB_DATABASE_2'),
            'OPERATION_NO' => $dms->quote->internal_ref,
            'DOC_TYPE' => 'INVOICE',
            'INVOICE_DATE' => $date,
            'PROJECT_ID' => $quotation->project_id,
            'CUST_ID' => $dms->Client_id,
            'STATUS' => 'UNPOSTED',
            'SAGE_INV_NO' => '',
            'FILE_REF_NO' => $dms->quote->file_number,
            'CONSIGNEE_NAME' => $quotation->consignee->consignee_name,
            'CARGO_DETAILS' => $quotation->cargos->first()->description,
            'BL_NO' => $quotation->cargos->first()->bl_no,
            'QTY' => $quotation->cargos->first()->bl_qty,
            'VESSEL' => $quotation->vessel->name,

        ]);
          foreach ($dms->quote->services as $service){
            $stockitem = StkItem::find($service->stk_id);
            $bill_details = BillDetail::create([
                'DEPT_NAME' => 'AGENCY',
                'ITEM_ID' => $service->tariff_id,
                'HEADER_ID' => $bill_header->SNo,
                'ITEM_DESC' =>  isset($stockitem->Description_2) ? $stockitem->Description_2 : ($stockitem->Description_3 ? $stockitem->Description_3  : $stockitem->Description_1),
                'ITEM_QTY' => $service->units,
                'UNIT_PRICE_EXCL' =>round((float)$service->total_excl,2),
                'VAT' => $service->tax_amount,
                'UNIT_COST' => round((float)$service->buying_price/(float)$service->units,2),
                'DOC_TYPE' => 'INVOICE',
                'STATUS' => 'UNPOSTED',
                'CURRENCY_ID' => $dms->Client_id
            ]);
        }

        $quotation->status = Constants::LEAD_QUOTATION_COMPLETED;
        $quotation->save();
        $projectName = ProjectRepo::init()->getProjectNumber($quotation->project_id);
        Mail::to(['email'=>'accounts@esl-eastafrica.com'])
            ->cc(['evans@esl-eastafrica.com','accounts@freightwell.com','accounts@sovereignlog.com'])
            ->send(new ProjectInvoice(['message'=>'Project '.$projectName.
                ' has been successfully closed by '. ucwords(Auth::user()->name) . ' on '.Carbon::now()->format('d-M-y H:m'). '. thank you for your support'],'PROJECT '. $projectName . ' COMPLETED'));

        $dms->status= 1;
        $dms->save();
        NotificationRepo::create()->success('Project completed successfully');
        return redirect()->back();
    }

    public function updateDms(Request $request)
    {

        $data = $request->all();
        $data['time_allowed'] = ($request->days * 24 * 60 * 60) + ($request->hour * 60 * 60) + ($request->min * 60) + $request->sec;
        $data['laytime_start'] = $request->laytime_time;
        $data['date_of_loading'] = $request->date_of_loading;
        $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
            'quote.voyage','customer','quote.cargos','quote.logs','consignee'])->findOrFail($request->dms_id);


        $dateTime = \DateTime::createFromFormat('d/m/Y', $request->eta);

        if ($dms->quote->voyage) {
           Voyage::findOrFail($dms->quote->voyage->id)->update(['eta'=>$dateTime,
            'vessel_arrived'=>$request->ata]);
        }
        
  
        Vessel::findOrFail($dms->vessel->id)->update(['eta'=>$dateTime  ]);
        foreach ($data['cargo_bl'] as $key => $datum){
            Cargo::findOrFail($key)->update(['bl_no'=>$datum]);
        }
        unset($data['cargo_bl']);
        unset($data['eta']);
        unset($data['eta_time']);
        unset($data['laytime_time']);
        unset($data['ata']);
        unset($data['ata_time']);
        unset($data['date_of_loading_time']);
        unset($data['dms_id']);
        unset($data['days']);
        unset($data['hour']);
        unset($data['min']);
        unset($data['sec']);
        unset($data['project_id']);
        unset($data['file_number']);

//        dd($data,$dms);
        $dms->update($data);
        $project_id='';
 if (isset($request['project_id'])){
     $project_id =  $request['project_id'];
 }else{
     $project_id = ProjectRepo::init()->generateName(str_replace("MV ","",$dms->vessel->name),$dms->vessel->imo_number)->makeProject()->ProjectLink;
 }

        //$project_id = ProjectRepo::init()->makeProject();
     //    dd($project_id);
        $quote = Quotation::findOrFail($dms->quote_id);
      //  dd($quote);
        $quote->project_id = $project_id;
        $quote->file_number = $request['file_number'];
        $quote->save();

        NotificationRepo::create()->message('PDA updated successfully','PDA Update');

        return redirect()->back();
    }

    public function generateSof($id)
    {
        $dms = BillOfLanding::with(['vessel','customer','quote.voyage',
            'quote.cargos.consignee'])->findOrFail($id);

        $bl_nos = '';
        $consignees = '';

        $cargos = $dms->quote->cargos;

        foreach ($cargos as $cargo){
            $bl_nos = $bl_nos.$cargo->bl_no.', ';
            $consignees = $consignees.$cargo->consignee->consignee_name.', ';
        }

        $port_stay = ceil($dms->quote->cargos->sum('weight')/$dms->quote->cargos->first()->discharge_rate);
        $laytime = [];
        $lowerpart['timeallowed'] = $this->getTimeDeatils($dms->time_allowed);

        if (count($dms->sof) < 1){
            NotificationRepo::create()->message('Add SOF data before you generate SOF','No SOF');
            return back();
        }
        foreach ($dms->sof->sortBy('to') as $sof){
//            if ($sof->action == 'calculate') {
                array_push($laytime, [
                    'day' => Carbon::parse($sof->to)->format('l'),
                    'date' => Carbon::parse($sof->from)->format('d-M-y'),
                    'from' => Carbon::parse($sof->from)->format('H:i'),
                    'to' => Carbon::parse($sof->to)->format('H:i'),
                    'period' => Carbon::parse($sof->from)->format('d.m.Y H:i') . ' HRS - ' . Carbon::parse($sof->to)->format('d.m.Y H:i') . ' HRS',
                    'time_to_count' =>$sof->total_cranes == 0 ? :  ($sof->crane_working * 100) / $sof->total_cranes,
                    'days' =>$this->getTimeDeatils($sof->total_cranes == 0 ? 0 :  (strtotime(Carbon::parse($sof->to)) - strtotime(Carbon::parse($sof->from))), ($sof->total_cranes == 0 ? 0 : ($sof->crane_working * 100) / $sof->total_cranes)),
                    'remarks' => $sof->remarks,
                    'secs' => abs($sof->total_cranes == 0 ? : $this->getTotalTimeUsed($this->getTimeDeatils(strtotime(Carbon::parse($sof->to)) - strtotime(Carbon::parse($sof->from)), ($sof->total_cranes == 0 ? 0 : ($sof->crane_working * 100) / $sof->total_cranes))))
                ]);
//            }
        }

        $lowerpart['laytimeused'] = $this->getTimeDeatils(collect($laytime)->sum('secs'));
        $lowerpart['timesave'] = $this->getTimeDeatils(($port_stay * 24 * 60 * 60) - collect($laytime)->sum('secs'));
        $data = [
            $lowerpart,
            'sofs'=>$laytime,
            [
                'vesselname' => $dms->vessel->name,
                'bl' => $bl_nos,
                'supplier' => $dms->quote->cargos->first()->shipper,
                'consignee' => $consignees,
                'arrive' => $dms->quote->voyage ? Carbon::parse($dms->quote->voyage->vessel_arrived)->format('d-M-y') : '',
                'weight' => $dms->quote->cargos->sum('weight'),
                'disch' => $dms->quote->cargos->first()->discharge_rate,
                'rate' => $dms->quote->cargos->first()->discharge_rate,
                'time' => $lowerpart['timeallowed'],
                'ltime' =>$dms->laytime_start,
            ]

        ];

        $sofs = collect($data['sofs'])->groupBy('date');

        $insertArray = [];

        $i = 0;

        foreach ($sofs as $date => $sof){
            foreach ($sof as $item){
                $i++;
                array_push($insertArray,[
                    'DATE' => $i == 1 ? $date : '',
                    'FROM' => $item['from'],
                    'TO' => $item['to'],
                    'REMARKS' => $item['remarks']
                ]);
            }

            $i = 0;
        }

        return (new FastExcel(collect($insertArray)))->download(time().'_sofs.xlsx');
    }

    public function generateLayTime($id)
    {
        $dms = BillOfLanding::with(['vessel','customer','quote.voyage',
            'quote.cargos.consignee'])->findOrFail($id);

        $bl_nos = '';
        $consignees = '';

        $cargos = $dms->quote->cargos;

        foreach ($cargos as $cargo){
            $bl_nos = $bl_nos.$cargo->bl_no.', ';
            $consignees = $consignees.$cargo->consignee->consignee_name.', ';
        }

        $port_stay = ceil($dms->quote->cargos->sum('weight')/$dms->quote->cargos->first()->discharge_rate);


            $laytime = [];
            $lowerpart['timeallowed'] = $this->getTimeDeatils($dms->time_allowed);


            foreach ($dms->sof->sortBy('to') as $sof){
                if ($sof->action == 'calculate') {
                    array_push($laytime, [
                        'day' => Carbon::parse($sof->to)->format('l'),
//                        'date' => Carbon::parse($sof->created_at)->format('d-M-y'),
                        'period' => Carbon::parse($sof->from)->format('d.m.Y H:i') . ' HRS - ' . Carbon::parse($sof->to)->format('d.m.Y H:i') . ' HRS',
                        'time_to_count' =>$sof->total_cranes == 0 ? :  ($sof->crane_working * 100) / $sof->total_cranes,
                        'days' =>$this->getTimeDeatils($sof->total_cranes == 0 ? 0 :  (strtotime(Carbon::parse($sof->to)) - strtotime(Carbon::parse($sof->from))), ($sof->total_cranes == 0 ? 0 : ($sof->crane_working * 100) / $sof->total_cranes)),
                        'remarks' => $sof->remarks,
                        'secs' => abs($sof->total_cranes == 0 ? : $this->getTotalTimeUsed($this->getTimeDeatils(strtotime(Carbon::parse($sof->to)) - strtotime(Carbon::parse($sof->from)), ($sof->total_cranes == 0 ? 0 : ($sof->crane_working * 100) / $sof->total_cranes))))
                    ]);
                }
            }

            $lowerpart['laytimeused'] = $this->getTimeDeatils(collect($laytime)->sum('secs'));
            $lowerpart['timesave'] = $this->getTimeDeatils(($port_stay * 24 * 60 * 60) - collect($laytime)->sum('secs'));
            $data = [
                $lowerpart,
                $laytime,
                [
                    'vesselname' => $dms->vessel->name,
                    'bl' => $bl_nos,
                    'supplier' => $dms->quote->cargos->first()->shipper,
                    'consignee' => $consignees,
                    'arrive' => $dms->quote->voyage ? Carbon::parse($dms->quote->voyage->vessel_arrived)->format('d-M-y') : '',
                    'weight' => $dms->quote->cargos->sum('weight'),
                    'disch' => $dms->quote->cargos->first()->discharge_rate,
                    'rate' => $dms->quote->cargos->first()->discharge_rate,
                    'time' => $lowerpart['timeallowed'],
                    'ltime' =>$dms->laytime_start,
                ]

            ];

        return view('pdf.laytime')
            ->withData($data);
    }

    public function getTotalTimeUsed($time)
    {
        $timeArray = explode(",",$time);
        if (count($timeArray)) {
            return (($timeArray[0] * 24 * 60 * 60) + ($timeArray[1] * 60 * 60) + ($timeArray[2] * 60) + ($timeArray[3]));
        }
    }

    function convert_seconds($seconds)
    {
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$seconds");
        return $dt1->diff($dt2)->format('%a days, %h hours, %i minutes and %s seconds');
    }

    public function updateBerth(Request $request)
    {
        $dms = BillOfLanding::findOrFail($request->id);
        $dms->berth_number = $request->berth_number;
        $dms->save();

        return redirect()->back();
    }

    public function getTimeDeatils($sec, $mlt=null)
    {

//        if($mlt != null){
//
//            $sec = ($sec * ($mlt/100));
//
//        }

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$sec");
        return $dtF->diff($dtT)->format('%a, %h, %i, %s');
    }

}
