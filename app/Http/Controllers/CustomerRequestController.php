<?php

namespace App\Http\Controllers;

use App\Client;
use App\GoodType;
use App\Lead;
use App\Quotation;
use Esl\helpers\Constants;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    public function customerRequest($quotation)
    {
        $quote = Quotation::find($quotation);
        $customer = Client::where('DCLink',$quote->client_id)->first();

//        if ($customer_type == Constants::LEAD_CUSTOMER)
//        {
//
//            return view('customers.request')
//                ->withCustomer($lead);
//        }

//        if ($customer_type == '000'){
//
//            return view('customers.other-request')
//                ->withCustomer($lead)
//                ->withType($request->type);
//        }

        return view('customers.request')
            ->withCustomer($customer)
            ->withQuotation($quote);
    }

    public function storeTemplate(){
        return response()->json(request()->all());
    }

}
