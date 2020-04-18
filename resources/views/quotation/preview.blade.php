@extends('layouts.main')
@section('content')
    @if(!\Illuminate\Support\Facades\Auth::guest())
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
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
{{--                <h3 class="text-center">{{ $quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED ? 'FDA' : 'PROFORMA DISBURSEMENT ACCOUNT' }}</h3>--}}
                <br>
                <div class="row">
                    @include('partials.invoice-head')
                    <hr>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-left">GRT/LOA</th>
                                    <th class="text-right">RATE</th>
                                    <th class="text-right">UNITS</th>
                                    <th class="text-right">Tax</th>
                                    <th class="text-right">Total (Incl)</th>
                                </tr>
                                </thead>
                                <tbody id="q_service">
                                @foreach($quotation->services as $service)
                                    <tr>
                                        <td>{{ ucwords($service->description) }}</td>
                                        <td class="text-left">{{ $service->grt_loa }}</td>
                                        <td class="text-right">{{ $service->agency_sp }}</td>
                                        <td class="text-right">{{ $service->units }}</td>
                                        <td class="text-right">{{ $service->tax }}</td>
                                        <td class="text-right">{{ number_format($service->total, 2) }}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p id="sub_ex">Total (Excl) {{$quotation->lead->currency }} :
                                {{ number_format($quotation->services->sum('total')) }}</p>
                            <p id="total_tax">Tax {{$quotation->lead->currency }} : {{ number_format($quotation->services->sum('total_tax', 2)) }} </p>
                            <p id="sub_in">Total (Incl) {{$quotation->lead->currency }} : {{ number_format($quotation->services->sum('total', 2)) }} </p>
                            <p id="rem_amount"><b>Remittance</b> {{$quotation->lead->currency }} : {{ number_format($quotation->remittance,2) }} </p>
                            <hr>
                            <h3 id="total_amount">Balance (Incl) {{$quotation->lead->currency }} : {{ number_format(($quotation->services->sum('total') - $quotation->remittance),2) }}</h3>
                        </div>
                        <div>
                            <address id="client_details text-left">
                                <p>
                                    <br><b>Prepared by :</b> {{ ucwords($quotation->user->name)  }}</p>
                                <p><b>Checked by :</b> {{ $quotation->checkedBy == null ? '................................' : ucwords($quotation->checkedBy->name )}}</p>
                                <p><b>Approved by :</b> {{ $quotation->approvedBy == null ? '................................' : ucwords($quotation->approvedBy->name) }}</p>

                                <p><b>Date :</b> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
                                {{--<h4><b>Signed :</b> ...........................</h4>--}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <address id="client_details text-right">
                                        <p style="font-weight: 600"> Thro' <i>Correspondent Bank, New York</i> <br> Bank Name: Standard Chartered Bank, New York
                                            <br>
                                            One Madison Avenue, New York, N.Y 10010-3603 USA
                                            <br>
                                            Account No: 3582021752001
                                            <br>
                                            Swift: SCBLUS33 <br>
                                            ABA Routing No: 026 002 561
                                        </p>
                                    </address>
                                </div>
                                <div>
                                    <address id="client_details text-left">
                                        <p style="font-weight: 600">
                                            <br>
                                            Bank Name: Commercial Bank of Africa
                                            <br>
                                            Branch: Moi Avenue-Mombasa <br>
                                            Account Numbers: {{ $quotation->lead->currency }} {{ $quotation->lead->currency == 'USD' ? '6616100021' : '6616100016'}}
                                            <br>
                                            Swift Address: CBAFKENX <br>
                                            Account Name : Express Shipping and Logistics EA Ltd
                                        </p>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="text-align: center !important;">
                                    <b>"Terms and Conditions Apply"</b>
                                    <br>
                                    We serve in the following Ports: Mombasa, Lamu, Tanga, Dar es Salaam, Mtwara, Zanzibar <br>
                                    <b style="font-size: small; color: red;">"Kindly note that for every Agency Fee paid, USD 100 goes to the support of our CSR programme"</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" style="margin-right: 8px !important;" class="btn btn-primary pull-left">Accept</a>
                                <a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" style="margin-right: 8px !important;" class="btn btn-danger pull-left" type="submit"> Decline</a>
                            @endif
                            <button id="print" class="btn btn-success pull-left" style="margin-right: 8px !important;" type="button"> <span><i class="fa fa-print"></i> Print/Download</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
