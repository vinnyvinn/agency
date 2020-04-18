<?php

namespace App\Http\Controllers;

use App\Consignee;
use App\Proforma;
use App\Quotation;
use App\QuotationService;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\QuotationServiceRepo;
use Esl\Repository\SaveInstanceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationServiceController extends Controller
{
    public function addQuotationService(Request $request)
    {
        $data = $request->all();
   //  dd($data);
        if ($request->has('type')){
            if ($request->proforma == null){
                $proforma = Proforma::create([
                    'user_id' => Auth::user()->id,
                    'lead_id' => $request->lead_id,
                    'currency' => $request->currency,
                    'consignee_id' => $request->consignee_id,
                    'status' => Constants::LEAD_QUOTATION_PENDING]);
                Consignee::findOrFail($request->consignee_id)->update(['quotation_id'=>$proforma->id]);
            }
            else{
                $proforma = Proforma::findOrFail($request->proforma );
            }
        }

//        dd($data,$proforma);

        foreach ($data['service'] as $datum) {
            QuotationService::create([
                'quotation_id' =>$request->has('type') ?  $proforma->id : $data['quotation'],
                'tariff_id' => $datum['tariff_id'],
                'stk_id' => $datum['stk_id'],
                'type' => $request->has('type') ? $data['type'] : 'pda',
                'description' => $datum['description'],
                'tax_code' => $datum['tax_code'],
                'tax_description' => $datum['tax_description'],
                'tax_id' => $datum['tax_id'],
                'tax_amount' => $datum['tax_amount'],
                'grt_loa' => $datum['grt_loa'],
                'rate' => $datum['rate'],
                'agency_sp' => $datum['agency_sp'],
                'units' => $datum['units'],
                'tax' => $datum['tax_amount'],
                'total' => (float)$datum['total'],
                'total_excl' => round((float)$datum['total_excl'],2),
                'buying_price' => round((float)$datum['buying_price'],2),
                'gp' => round((float)$datum['gp'],2),
                'gp_percentage' => round((float)$datum['gp_percentage'],2),

            ]);
        }

        if ($request->has('type')){
            $proforma->status = Constants::LEAD_QUOTATION_PENDING;
            $proforma->save();
        }
        else {
            $quote = Quotation::with(['lead', 'parties', 'cargos.goodType', 'consignee',
                'vessel', 'voyage', 'services.tariff', 'remarks.user'])->findOrFail($data['quotation']);

            $quote->status = Constants::LEAD_QUOTATION_PENDING;
            $quote->save();
            SaveInstanceRepo::init()->Quotation($data['quotation'], $quote->toArray());
        }

        return Response(['success' => $this->quotationServices($request->has('type') ?  $proforma->id : $data['quotation'])]);

    }

    public function deleteQuotationService(Request $request)
    {
        $service = QuotationService::findOrFail($request->service_id);
        $service->delete();

        $quote = Quotation::with(['lead','parties','cargos.goodType','consignee',
            'vessel','voyage','services.tariff','remarks.user'])->findOrFail($service->quotation_id);
        $quote->status = Constants::LEAD_QUOTATION_PENDING;
        $quote->save();
        SaveInstanceRepo::init()->Quotation($service->quotation_id,$quote->toArray());

        return Response(['success' => $this->quotationServices($request->quotation_id)]);
    }

    public function updateService(Request $request)
    {
//        dd($request->all());
        $tax = json_decode($request->tax);
        $service = QuotationService::findOrFail($request->service_id);
        if ($request->tariff_type == 'kpa' || $request->tariff_type == 'loa'){
            $updateData = [
                'tax_code' => $tax->Code,
                'tax_description' => $tax->Description,
                'tax_id' => $tax->idTaxRate,
                'tax_amount' => (($tax->TaxRate) * ($request->grt_loa * $request->agency_sp * $request->units) / 100),
                'description' => $request->description,
                'grt_loa' => $request->grt_loa,
                'rate' => $request->rate,
                'agency_sp' => $request->agency_sp,
                'units' => $request->units,
                'tax' => (($tax->TaxRate) * ($request->grt_loa * $request->agency_sp * $request->units) / 100),
                'total' => ((($tax->TaxRate) * ($request->grt_loa * $request->agency_sp * $request->units) / 100) + ($request->grt_loa * $request->agency_sp * $request->units))
            ];
        }
        elseif ($request->tariff_type == 'Thereafter GRT'){
            $grt = $request->grt_loa - 100;
            $updateData = [
                'tax_code' => $tax->Code,
                'tax_description' => $tax->Description,
                'tax_id' => $tax->idTaxRate,
                'tax_amount' => (($tax->TaxRate) * ($grt * $request->agency_sp * $request->units) / 100),
                'description' => $request->description,
                'grt_loa' => $request->grt_loa,
                'rate' => $request->rate,
                'agency_sp' => $request->agency_sp,
                'units' => $request->units,
                'tax' => (($tax->TaxRate) * ($grt * $request->agency_sp * $request->units) / 100),
                'total' => ((($tax->TaxRate) * ($grt * $request->agency_sp * $request->units) / 100) + ($grt * $request->agency_sp * $request->units))
            ];
        }
        else{
//        elseif ($request->tariff_type == 'Per Unit' || $request->tariff_type == 'Lumpsum' || $request->tariff_type == 'per day'){
            $updateData = [
                'tax_code' => $tax->Code,
                'tax_description' => $tax->Description,
                'tax_id' => $tax->idTaxRate,
                'tax_amount' => (($tax->TaxRate) * ($request->agency_sp * $request->units) / 100),
                'description' => $request->description,
                'grt_loa' => $request->grt_loa,
                'rate' => $request->rate,
                'agency_sp' => $request->agency_sp,
                'units' => $request->units,
                'tax' => (($tax->TaxRate) * ($request->agency_sp * $request->units) / 100),
                'total' => ((($tax->TaxRate) * ($request->agency_sp * $request->units) / 100) + ($request->agency_sp * $request->units))
            ];
        }

        $service->update($updateData);

        if ($request->has('type')){
            $proforma = Proforma::findOrFail($service->quotation_id);
            $proforma->status = Constants::LEAD_QUOTATION_PENDING;
            $proforma->save();
        }
        else {
            $quote = Quotation::with(['lead', 'parties', 'cargos.goodType', 'consignee',
                'vessel', 'voyage', 'services.tariff', 'remarks.user'])->findOrFail($service->quotation_id);
            $quote->status = Constants::LEAD_QUOTATION_PENDING;
            $quote->save();
            SaveInstanceRepo::init()->Quotation($service->quotation_id, $quote->toArray());
        }
        return Response(['success' => 'done']);
    }

    private function quotationServices($id)
    {
        $result = QuotationServiceRepo::init()->getQuotationServices($id);

        $output = "";
        foreach ($result['services'] as $item) {
            $output .= '<tr>' .
                '<td>' . ucwords($item->description) . '</td>';
                if ($item->grt_loa != null){
                    $output = $output . '<td class="text-right">' . $item->grt_loa . '</td>';
                }
            $output = $output .'<td class="text-right">'.$item->agency_sp.'</td>'.
                '<td class="text-right">'.$item->units.'</td>'.
                '<td class="text-right">'.$item->tax.'</td>'.
                '<td class="text-right">'.number_format($item->total).'</td>'.
                '<td class="text-right"><button onclick="deleteService('.$item->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>'.
                '</tr>';
        }

        unset($result['services']);
        $result['services'] = $output;

        return $result;
    }
}
