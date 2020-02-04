<?php

namespace App\Http\Controllers;

use App\GoodType;
use App\Lead;
use Esl\helpers\Constants;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    public function customerRequest(Request $request, $customer_id, $customer_type)
    {
        $lead = Lead::findOrfail($customer_id);

        if ($customer_type == Constants::LEAD_CUSTOMER)
        {

            return view('customers.request')
                ->withCustomer($lead);
        }

        if ($customer_type == '000'){

            return view('customers.other-request')
                ->withCustomer($lead)
                ->withType($request->type);
        }
    }

    public function storeTemplate(){
        return response()->json(request()->all());
    }

}
