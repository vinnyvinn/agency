<?php

namespace App\Http\Controllers;

use App\Client;
use App\Lead;
use App\Quotation;
use App\QuotationService;
use App\ServiceTax;
use App\Tariff;
use App\Vessel;
use Esl\helpers\Constants;
use Illuminate\Http\Request;

class AgencyQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Quotation::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = json_decode($request->quotation, true);
        $client = Client::where('DCLink',$input['company']['DCLink'])->first();
         $lead = Lead::create([
             'name' => $client->Name,
             'client_id' => $input['company']['DCLink'],
             'contact_person' => $client->Contact_Person,
             'phone' => $client->Telephone,
             'email' => $client->EMail,
             'currency' => $input['currency'],
             'telephone' => $client->Telephone,
             'cPhysicalAddress1' => $client->cPhysicalAddress1,
             'cPhysicalAddress2' => $client->cPhysicalAddress2
         ]);
            $quotation = Quotation::create([
            'user_id' => 2,
            'lead_id' => $lead->id,
            'vessel_id' => Vessel::count()+1,
            'status' => Constants::LEAD_QUOTATION_PENDING
        ]);
        foreach ($input['items'] as $item) {
            if ($item['department'] == 'agency'){
                $service = Tariff::where(function ($query) use ($item) {
                    $query->where('name', 'LIKE', '%' . $item['name'] . '%');
                })->first();
                $tax = ServiceTax::where('TaxRate', $item['tax_rate'])->first();
                QuotationService::create([
                    'quotation_id' =>$quotation->id,
                    'tariff_id' =>  $service->id,
                    'stk_id' =>  $service->stk_id,
                    'type' => 'pda',
                    'description' => $item['description'],
                    'tax_code' => $tax->tax_code,
                    'tax_description' =>$tax->Description,
                    'tax_id' => $tax->idTaxRate,
                    'tax_amount' => $tax->TaxRate,
                    'grt_loa' => $service->unit_type,
                    'rate' => round((float)$item['tax_total'], 2),
                    'agency_sp' => $service->rate,
                    'units' => round((float)$item['quantity'], 2),
                    'tax' => round((float)$item['tax_total'], 2),
                    'total' => round((float)$item['total_cost'], 2)
                ]);

            }
        }

        return $quotation;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
