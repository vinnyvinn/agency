@extends('layouts.main')
@section('content')
    {{--@if(!\Illuminate\Support\Facades\Auth::guest())--}}
        <div class="row page-titles m-b-0">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <div>
                <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
            </div>
        </div>
    {{--@endif--}}
    <div class="container-fluid">
        <div class="row" style="font-size: 10pt !important;">
            <div class="col-sm-12">
                <div class="card card-body printableArea">
                <div style="background-color: white !important;" width="100%">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <img style="padding: 20px;" src="{{ asset('images/esl.png') }}" alt="" width="100% !important" height="auto">
                        </div>
                    </div>
                    <div class="row" style="background-color: blue">
                        <div class="col-sm-12">
                            <h3 class="text-center" style="margin: 0px;padding: 16px; text-align: center !important;"><strong style="color: black;text-align: center !important;"> DELIVERY ORDER </strong> </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <h4><b>KENYA PORTS AUTHORITY, KILINDINI</b></h4>
                        </div>
                        <div class="col-sm-4">
                            <h4><p style="text-align: right !important;"><b style="text-align: right !important; color: #000;">DATE: {{ \Carbon\Carbon::now()->format('d.m.Y') }}</b></p></h4>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div style="width: 33% !important;" class="col-sm-4">--}}
                            {{--<p style="font-size: 10px"><b>DELIVERY ORDER NO.</b></p>--}}
                        {{--</div>--}}
                        {{--<div style="width: 33% !important;" class="col-sm-4">--}}
                            {{--<p style="font-size: 10px"><b>{{ 728 + count(\App\BillOfLanding::all()) }} </b></p>--}}
                        {{--</div>--}}
                        {{--<div style="width: 33% !important;" class="col-sm-4">--}}
                            {{--<p style="font-size: 10px"><b>DATE: {{ \Carbon\Carbon::now()->format('d.m.Y') }}</b> </p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="row">
                        <div class="col-sm-12">
                            <h4 style="font-size: 16px; text-align: center !important;"><b style="text-align: center !important;">DELIVERY ORDER NO : {{ 728 + count(\App\BillOfLanding::all()) }} </b></h4>
                        </div>
                    </div>
                    <hr style="border:1px solid #000;">
                    <div class="row">
                        <div class="col-sm-12" style="padding: 0px !important; margin: 0px !important;">
                            <h4><b>PLEASE AUTHORISE RELEASE OF THE UNDERMENTIONED GOODS TO:</b> <strong>{{ strtoupper($dos['client']) }}</strong></h4>
                        </div>
                    </div>
                    <div class="row" style="width: 100% !important;">
                            <div style="width: 60% !important;">
                                <h4 style="font-size: 14px"><b>Consignee</b> <br>
                                    {!!  str_replace(",","<br>",strtoupper($dos['consignee']))  !!}
                                    <br>
                                    <br>
                                    <b>Shipper</b> <br>
                                    {!!  str_replace(",","<br>",strtoupper($dos['shipper']))  !!}
                                    <br>
                                    <br>
                                    <b>Notify Party</b> <br>
                                    {!!  str_replace(",","<br>",strtoupper($dos['party']))  !!}</h4>
                            </div>
                            <div style="width: 40% !important;">
                                <ul class="list-group pull-right">
                                    <li class="list-group-item"><b style="font-weight: 600">VESSEL: {{ strtoupper($dms->vessel->name) }}</b></li>
                                    <li class="list-group-item"><b style="font-weight: 600">E.T.A: {{ \Carbon\Carbon::parse($dms->vessel->eta)->format('d.m.Y') }}</b></li>
                                    <li class="list-group-item"><b style="font-weight: 600">B/L NO: {{ strtoupper($client->cargo->bl_no) }}</b></li>
                                    <li class="list-group-item"><b style="font-weight: 600">PORT OF LOADING: {{ strtoupper($dms->vessel->port_of_loading.', '.$dms->vessel->country_of_loading )}}</b></li>
                                </ul>

                            </div>
                    </div>
                    <div class="row">
                        <br>
                    </div>
                    <div class="row">
                        <table width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center !important; width: 33%; border: 1px solid black !important;"><p><b>MARKS/NUMBERS</b></p></th>
                                <th style="text-align: center !important; width: 33%; border: 1px solid black !important;"><p><b>DESCRIPTION</b></p></th>
                                <th style="text-align: center !important; width: 33%; border: 1px solid black !important;"><p><b>WEIGHT(KGS)</b></p></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="text-align: center !important; width: 33%; border: 1px solid black !important;">
                                    <p style="font-size: 10px;font-weight: bold">{{ strtoupper($dos['marks'])  }}</p>
                                </td>
                                <td style="text-align: center !important; width: 33%; border: 1px solid black !important;">
                                    <p style="font-size: 10px;font-weight: bold">{!!  strtoupper(str_replace(",","<br>",strtoupper($dos['description'])))  !!}</p>
                                </td>
                                <td style="text-align: center !important; width: 33%; border: 1px solid black !important;">
                                    <p style="font-size: 10px;font-weight: bold">{{  number_format(($client->cargo->weight * 1000),2) }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="pull-right text-center" style="font-size: 14px"><br>Released subject to payment of landing charges prior to delivery <br>
                                FOR: <b style="font-weight: 600">EXPRESS SHIPPING & LOGISTICS(EA) LTD</b>
                          <br>
                                <br>
                                <br>
<span style="font-weight: 600"> AS AGENTS ONLY</span>
                            </p>


                            {{--<div class="col-sm-2 pull-right">--}}
                            {{--</div>--}}
                        </div>
                        <div class="col-sm-12">

                                <p class="text-center" style="font-size: 14px;font-weight: bold">{{strtoupper($dos['client'])}}</p>
                            </div>

                    </div>
                </div>
                </div>
                <div class="text-right">
                    <button id="print" class="btn btn-success" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                </div>
            </div>
        </div>
    </div>
@endsection

