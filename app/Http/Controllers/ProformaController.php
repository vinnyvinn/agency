<?php

namespace App\Http\Controllers;

use App\Consignee;
use App\ContainerType;
use App\Customer;
use App\GoodType;
use App\Proforma;
use App\Quotation;
use App\ServiceTax;
use App\Tariff;

class ProformaController extends Controller
{
    public function showQuotation($id)
    {
//        dd($id);
        $consignee = Consignee::with(['cargo'])->findOrFail($id);

        $quote = Quotation::with(['lead','parties','cargos.goodType','cargos.consignee',
            'vessel','voyage','services.tariff','remarks.user'])->findOrFail($consignee->cargo->quotation_id);

        $proforma = Proforma::with(['services.tariff','services'=>function($query){
            $query->where('type','proforma');
        }])->where('consignee_id', $id)->get()->first();

        $client = $proforma == null ? null : Customer::findOrFail($proforma->lead_id);
//        dd($proforma, $client);

        return view('quotation.proforma')
            ->withQuotation($proforma)
            ->withQuote($quote)
            ->withCustomer($client)
            ->withConsignee($consignee)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withGoodtypes(GoodType::all())
            ->withContainertypes(ContainerType::all())
            ->withTariffs(Tariff::all()->sortBy('name'));
    }


    public function downloadProforma($id)
    {
        $consignee = Consignee::with(['cargo'])->findOrFail($id);

        $quote = Quotation::with(['lead','parties','cargos.goodType','cargos.consignee',
            'vessel','voyage','services.tariff','remarks.user'])->findOrFail($consignee->cargo->quotation_id);

        $proforma = Proforma::with(['services.tariff','services'=>function($query){
            $query->where('type','proforma');
        }])->where('consignee_id', $id)->get()->first();


        $client = $proforma == null ? null : Customer::findOrFail($proforma->lead_id);

        return view('pdf.proformainv')
            ->withQuotation($proforma)
            ->withQuote($quote)
            ->withCustomer($client)
            ->withConsignee($consignee)
            ->withTariffs(Tariff::all()->sortBy('name'));
    }



}
