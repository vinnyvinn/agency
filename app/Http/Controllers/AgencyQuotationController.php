<?php

namespace App\Http\Controllers;

use App\Client;
use App\Lead;
use App\Quotation;
use App\QuotationService;
use App\ServiceTax;
use App\Tariff;
use App\Vessel;
use Carbon\Carbon;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formatted = json_decode($request->get('quotation'));
        $date = Carbon::now()->format('d-M-y');
        $quote = Quotation::count()+1;
        $quotationData = [
            'user_id' => 1,
            'client_id' =>$formatted->company->DCLink,
            'status' => Constants::LEAD_QUOTATION_PENDING,
            'internal_ref' => 'Q'.$date.'-'.$quote,
            'crm_ref' => $formatted->reference_no
        ];
        $quotation = Quotation::create($quotationData);
        foreach ($formatted->items as $item) {
            if ($item->department == 'agency'){
                $service = Tariff::where('name',$item->name)->first();
                $tax = ServiceTax::where('TaxRate', $item->tax_rate)->first();
                QuotationService::create([
                    'quotation_id' =>$quotation->id,
                    'tariff_id' =>  $service->id,
                    'stk_id' =>  $service->stk_id,
                    'type' => 'pda',
                    'description' => $item->description,
                    'tax_code' => $tax->Code,
                    'tax_description' =>$tax->Description,
                    'tax_id' => $tax->idTaxRate,
                    'tax_amount' => round((float)$item->tax_total, 2),
                    'grt_loa' => $service->unit_type,
                    'rate' => round((float)$item->tax_total, 2),
                    'agency_sp' => $service->rate,
                    'units' => round((float)$item->quantity, 2),
                    'tax' => round((float)$item->tax_total, 2),
                    'total' => round((float)$item->total_cost, 2),
                    'buying_price' =>round((float)$service->buying_price*(float)$item->units),
                    'gp' => round(((float)$item->total_cost-(float)$item->tax_total)-(float)$service->buying_price,2),
                    'gp_percentage' => round((((float)$item->total_cost-(float)$item->tax_total)-(float)$service->buying_price)/((float)$item->total_cost-(float)$item->tax_total)*100,2) ,
                    'total_excl' => round(($item->total_cost-$item->tax_total),2)
                ]);
            }
        }
        return response()->json($quotation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request,$id)
    {
   //$input = json_decode($request->quotation, true);
   $date = Carbon::now()->format('d-M-y');
   $input1 ='{"id":26,
   "reference_no":"EST-20200316-0022",
   "title":"setry io",
   "client_id":16,
   "deal_id":0,
   "due_date":"2020-04-15 00:00:00",
   "currency":"KES",
   "discount":"0.00",
   "notes":"Looking forward to doing business with you.",
   "tax":"16.00",
   "tax2":"0.00",
   "status":"Accepted",
   "sent_at":null,
   "viewed_at":null,
   "discount_percent":1,
   "invoiced_id":56,
   "invoiced_at":"2020-03-16 21:16:55",
   "accepted_time":"2020-03-16 21:16:55",
   "rejected_time":null,
   "rejected_reason":null,
   "exchange_rate":"102.68385",
   "is_visible":0,
   "amount":"0.00",
   "sub_total":"0.00",
   "discounted":"0.00",
   "tax1_amount":"0.00",
   "tax2_amount":"0.00",
   "reminded_at":null,
   "archived_at":null,
   "deleted_at":null,
   "created_at":"2020-03-16 21:04:36",
   "updated_at":"2020-03-16 21:16:55", 
     "items":[      {
         "id":105,
         "tax_rate":16,
         "tax_total":"3200.00",
         "quantity":1,
         "unit_cost":20000,
         "discount":0,
         "total_cost":1500,
         "name":"Hotel Accomodation charges",
         "description":"Pre-inspection",
         "order":1,
         "itemable_type":"Modules\\\\Estimates\\\\Entities\\\\Estimate",
         "itemable_id":26,
         "created_at":"2020-03-16 21:13:25",
         "updated_at":"2020-03-16 21:13:25",
         "deleted_at":null,
         "department":"agency"
      
}
   
],
   "company":{
      "id":16,
      "code":"T002",
      "individual":0,
      "name":"Evergreen - Transporte Multimodal S.A DE C.V",
      "primary_contact":null,
      "email":"",
      "website":null,
      "phone":null,
      "mobile":null,
      "fax":null,
      "address1":"Benjamin Franklin No.216",
      "address2":null,
      "city":null,
      "state":null,
      "locale":"en",
      "country":null,
      "tax_number":"",
      "zip_code":null,
      "currency":"USD",
      "expense":"0.00",
      "balance":"0.00",
      "paid":"0.00",
      "skype":null,
      "linkedin":null,
      "facebook":null,
      "twitter":null,
      "notes":null,
      "logo":"\\/storage\\/logos\\/default_avatar.png",
      "owner":null,
      "slack_webhook_url":null,
      "unsubscribed_at":null,
      "deleted_at":null,
      "created_at":null,
      "updated_at":null,
      "stripe_id":null,
      "card_brand":null,
      "card_last_four":null,
      "trial_ends_at":null,
      "DCLink":"35",
      "Account":"T002",
      "contact_person":null,
      "expense_cost":"$0.00",
      "outstanding":"$0.00",
      "map":"Benjamin+Franklin+No.216%2C+%2C%2C",
      "maplink":"https:\\/\\/maps.google.com\\/maps?q=Benjamin Franklin No.216+++",
      "contact":null
   
},
   "tags":[]    
}';

        $formatted = json_decode($input1);
        $quote = Quotation::count()+1;
        $quotationData = [
            'user_id' => 1,
            'client_id' =>$formatted->company->DCLink,
            'status' => Constants::LEAD_QUOTATION_PENDING,
            'internal_ref' => 'Q'.$date.'-'.$quote,
            'crm_ref' => $formatted->reference_no
        ];
        $quotation = Quotation::create($quotationData);
        foreach ($formatted->items as $item) {
            if ($item->department == 'agency'){
                $service = Tariff::where('name',$item->name)->first();
                $tax = ServiceTax::where('TaxRate', $item->tax_rate)->first();
                QuotationService::create([
                    'quotation_id' =>$quotation->id,
                    'tariff_id' =>  $service->id,
                    'stk_id' =>  $service->stk_id,
                    'type' => 'pda',
                    'description' => $item->description,
                    'tax_code' => $tax->Code,
                    'tax_description' =>$tax->Description,
                    'tax_id' => $tax->idTaxRate,
                    'tax_amount' => round((float)$item->tax_total, 2),
                    'grt_loa' => $service->unit_type,
                    'rate' => round((float)$item->tax_total, 2),
                    'agency_sp' => $service->rate,
                    'units' => round((float)$item->quantity, 2),
                    'tax' => round((float)$item->tax_total, 2),
                    'total' => round((float)$item->total_cost, 2),
                    'buying_price' =>round((float)$service->buying_price*(float)$item->quantity),
                    'gp' => round(((float)$item->total_cost-(float)$item->tax_total)-(float)$service->buying_price,2),
                    'gp_percentage' => round((((float)$item->total_cost-(float)$item->tax_total)-(float)$service->buying_price)/((float)$item->total_cost-(float)$item->tax_total)*100,2) ,
                    'total_excl' => round(($item->total_cost-$item->tax_total),2)
                ]);

            }
        }

        return $quotation;
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
