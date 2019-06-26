@extends('layouts.main')
@section('content')
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
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
                <h3 class="text-center">PROFORMA</h3>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                {{--<h4>Express Shipping & Logistics (EA) Limited</h4>--}}
                                <h4>Cannon Towers <br>
                                    6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email :agency@esl-eastafrica.com or <br> ops@esl-eastafrica.com <br>
                                    Web: www.esl-eastafrica.com<br>
                                    <b>Tax Registration</b>: 0121303W <br>
                                    <b>Telephone</b>: +254 41 2229784
                                </h4>
{{--                                <h4> &nbsp;<b>TO : {{ ucwords($quotation->lead->name) }}</b></h4>--}}
                                {{--<h4 class="m-l-5"><strong>Contact Person : </strong> {{ ucwords($quotation->lead->contact_person) }}--}}
                                    {{--<br/> <strong>Tel/Email : </strong> {{ $quotation->lead->telephone }} {{ $quotation->lead->email }}--}}
                                    {{--<br/> <strong>Phone : </strong> {{ $quotation->lead->phone }}--}}
                                {{--</h4>--}}
                                <h4>&nbsp;<b>CARGO  </b> {{ ucwords($consignee->cargo->name) }}</h4>
                                <br>
                                <h4>&nbsp;<b>CARGO  QUANTITY </b> {{ $consignee->cargo->weight }} MT</h4>
                                <h4>&nbsp;<b>DISCHARGE RATE</b>  {{ $consignee->cargo->discharge_rate }}  MT / WWD</h4>
                                <h4>&nbsp;<b>PORT STAY  </b> {{ ceil(($consignee->cargo->weight)/$consignee->cargo->discharge_rate) }} Days</h4>
                            </address>
                        </div>
                        <div class="pull-right">
                            <div class="row">
                                <div class="form-group">
                                    <h1 style="color: {{ $quotation == null ? ' ' : $quotation->status == 'pending' ? 'red' : ($quotation->status == 'accepted' ||
                                    $quotation->status == 'converted' ? 'green' : 'gray') }}">{{ $quotation == null ? ' ' : strtoupper($quotation->status ==
                                    'pending' ? 'DRAFT' : $quotation->status) }}</h1>
                                    {{--<h3>Tax Registration: 0121303W</h3>--}}
                                    {{--<h3>Telephone: +254 41 2229784</h3>--}}
                                    {{--<label><h4><b>Currency</b></h4></label>--}}
                                    {{--<select class="form-control" name="currency" id="currency">--}}
                                        {{--<option value="">Select Currency</option>--}}
                                        {{--<option value="usd">USD</option>--}}
                                        {{--<option value="kes">KES</option>--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                            <address>
                                {{--<h4><b>Job No</b> ESL002634</h4>--}}
                                <h4><b>Voyage No</b> {{ $quote->voyage == null ? '' : strtoupper($quote->voyage->voyage_no) }}</h4>
                                <h4>Currency : {{ $quote->lead->currency }}</h4>
                                <h4 id="vessel_name"><b>BL NO</b> {{ strtoupper($consignee->cargo->bl_no )}}</h4>
                                <h4 id="grt"><b>Consignee Name</b> {{ $consignee->consignee_name}}</h4>
                                <h4 id="loa"><b>Consignee Tel</b> {{ $consignee->consignee_tel}}</h4>
                                <h4 id="port"><b>Consignee Address</b> {{ $consignee->consignee_address}}</h4>
                                <br>
                                <p><b>Date : </b> {{ $quotation == null ? ' ' :\Carbon\Carbon::parse($quotation->updated_at)->format('d-M-y') }}</p>
                                @if($quotation == null)
                                <div id="add_customer" class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="customer"><h4>Add Customer</h4></label>
                                        <input type="text" id="customer" class="form-control" placeholder="Search customer">
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="display"></div>
                                </div>
                                </div>
                                @endif
                                <address id="client_details">
                                    @if($quotation != null)
                                        <div class="col-sm-12"><h4><b>To</b></h4>
                                            <h4 id="client-name"> Name : {{ $customer->Name }}</h4>
                                            <h4 id="contact-person">Contact Person : {{ $customer->Contact_Person }}</h4>
                                            <h4 id="contact-phone">Phone : {{ $customer->Telephone }}</h4>
                                            <h4 id="contact-email">Email : {{ $customer->EMail }} </h4></div>
                                        <h4 id="contact-currency">Currency : {{ $quotation->currency }}</h4>
                        @endif
                                </address>
                            </address>
                        </div>
                    </div>
                    <hr>

                    {{--<div class="card-body wizard-content">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body">--}}
                                    {{--<h4 class="card-title">Customer Request Details</h4>--}}
                                    {{--<ul class="nav nav-tabs" role="tablist">--}}
                                        {{--<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a> </li>--}}
                                        {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Cargo / Consignee Details</span></a> </li>--}}
                                        {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Details</span></a> </li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="tab-content tabcontent-border">--}}
                                        {{--<div class="tab-pane active" id="home" role="tabpanel">--}}
                                            {{--<div class="p-20">--}}
                                                {{--<table class="table table-boarded">--}}
                                                    {{--<tr>--}}
                                                        {{--<td><strong>Name : </strong> {{ $quotation->vessel->name }}</td>--}}
                                                        {{--<td><strong>Country : </strong> {{ $quotation->vessel->country }}</td>--}}
                                                        {{--<td><strong>Call Sign : </strong> {{ $quotation->vessel->call_sign }}</td>--}}
                                                        {{--<td><strong>IMO Number : </strong> {{ $quotation->vessel->imo_number }}</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><strong>LOA : </strong> {{ $quotation->vessel->loa }}</td>--}}
                                                        {{--<td><strong>GRT : </strong> {{ $quotation->vessel->grt }}</td>--}}
                                                        {{--<td><strong>Consignee Goods : </strong> {{ $quotation->cargos->sum('weight') }}</td>--}}
                                                        {{--<td><strong>NRT : </strong> {{ $quotation->vessel->nrt }}</td>--}}
                                                    {{--</tr>--}}
                                                    {{--<tr>--}}
                                                        {{--<td><strong>DWT : </strong> {{ $quotation->vessel->dwt }}</td>--}}
                                                        {{--<td><strong>Port of Discharge: </strong> {{ $quotation->vessel->port_of_discharge }} , {{ $quotation->vessel->country_of_loading }}</td>--}}
                                                        {{--<td><strong>Port of Loading: </strong> {{ $quotation->vessel->port_of_loading }} , {{ $quotation->vessel->country_of_loading }}</td>--}}
                                                        {{--<td><strong>ETA : </strong> {{ $quotation->vessel->eta != null ? \Carbon\Carbon::parse($quotation->vessel->eta)->format('d-M-y') : ' ' }}</td>--}}
                                                    {{--</tr>--}}
                                                {{--</table>--}}
                                                {{--<button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-primary">--}}
                                                    {{--Edit Detail--}}
                                                {{--</button>--}}
                                                {{--<div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">--}}
                                                    {{--<div class="modal-dialog modal-lg">--}}
                                                        {{--<div class="modal-content">--}}
                                                            {{--<div class="modal-header">--}}
                                                                {{--<h4 class="modal-title" id="myLargeModalLabel">Edit</h4>--}}
                                                                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-body">--}}
                                                                {{--<div class="col-12">--}}
                                                                    {{--<form class="form-material m-t-40" onsubmit="event.preventDefault();submitForm(this, '/update-vessel-details','redirect');" method="post" id="vessel">--}}
                                                                        {{--<div class="row">--}}
                                                                            {{--<div class="col-sm-6">--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<input type="hidden" value="{{$quotation->lead_id}}" name="lead_id">--}}
                                                                                    {{--<label for="name">Vessel Name</label>--}}
                                                                                    {{--<input type="text" required id="name" name="name" value="{{ $quotation->vessel->name }}" class="form-control" placeholder="Name">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="call_sign">Call Sign</label>--}}
                                                                                    {{--<input type="text"  id="call_sign" name="call_sign" value="{{ $quotation->vessel->call_sign }}" class="form-control" placeholder="HS Code">--}}
                                                                                {{--</div>--}}
                                                                                {{--<input type="hidden" value="{{$quotation->id}}" name="quote_id">--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="imo_number">IMO Number </label>--}}
                                                                                    {{--<input type="text"  id="imo_number" value="{{ $quotation->vessel->imo_number }}" name="imo_number" class="form-control" placeholder="IMO Number">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="country">Country </label>--}}

                                                                                    {{--<select style="width: 100% !important;" required name="country" id="country"--}}
                                                                                            {{--class="select2 form-control">--}}
                                                                                        {{--<option value="">Select Country</option>--}}
                                                                                        {{--@foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)--}}
                                                                                            {{--<option {{ $quotation->vessel->country == $value ? 'selected' : ''}} value="{{$value}}">{{$value}}</option>--}}
                                                                                        {{--@endforeach--}}
                                                                                    {{--</select>--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="port_of_discharge"> Port of Loading</label>--}}
                                                                                    {{--<input type="text" id="port_of_discharge" value="{{ $quotation->vessel->port_of_discharge }}" required name="port_of_discharge" class="form-control" placeholder="Port">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="port_of_loading"> Port of Discharge</label>--}}
                                                                                    {{--<input type="text" id="port_of_loading" value="{{ $quotation->vessel->port_of_loading }}" required name="port_of_loading" class="form-control" placeholder="Port">--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="col-sm-6">--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="loa">Length Over All </label>--}}
                                                                                    {{--<input type="number" id="loa" name="loa" value="{{ $quotation->vessel->loa }}" required class="form-control" placeholder="Lenth Over All">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="grt">Gross Tonnage  GRT</label>--}}
                                                                                    {{--<input type="number" id="grt" name="grt" value="{{ $quotation->vessel->grt }}" required class="form-control" placeholder="Gross Tonnage ">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="consignee_good"> Consignee Goods GT </label>--}}
                                                                                    {{--<input type="number" id="consignee_good" value="{{ $quotation->vessel->consignee_good }}" required name="consignee_good" class="form-control" placeholder="Net Tonnage">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="nrt"> Net Tonnage</label>--}}
                                                                                    {{--<input type="number" id="nrt" name="nrt"  value="{{ $quotation->vessel->nrt }}" class="form-control" placeholder="Consignee Goods">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="nrt"> ETA</label>--}}
                                                                                    {{--<input type="text" id="eta" name="eta"  value="{{ $quotation->vessel->eta }}" class="datepicker form-control">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="dwt"> Dead Weight - including provision</label>--}}
                                                                                    {{--<input type="number" id="dwt" name="dwt"  value="{{ $quotation->vessel->dwt }}" class="form-control" placeholder="Dead Weight - including provision">--}}
                                                                                {{--</div>--}}
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<br>--}}
                                                                                    {{--<input class="btn btn-block btn-primary" type="submit" value="Update">--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</form>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-footer">--}}
                                                                {{--<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="tab-pane  p-20" id="profile" role="tabpanel">--}}
                                            {{--@if(count($quotation->cargos) < 1)--}}
                                            {{--<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lgcargo">Add Details</button>--}}
                                            {{--@endif--}}
                                                {{--<div class="modal fade bs-example-modal-lgcargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">--}}
                                                {{--<div class="modal-dialog modal-lg">--}}
                                                    {{--<div class="modal-content">--}}
                                                        {{--<div class="modal-header">--}}
                                                            {{--<h4 class="modal-title" id="myLargeModalLabel">Add Details</h4>--}}
                                                            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="modal-body">--}}
                                                            {{--<div class="col-12">--}}
                                                                {{--<form class="m-t-40" onsubmit="event.preventDefault(); submitForm(this,'/cargo-details')" method="post" id="cargo">--}}
                                                                    {{--<div class="row">--}}
                                                                        {{--<div class="col-sm-6">--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="name">Cargo Name</label>--}}
                                                                                {{--<input type="text" required id="name" name="name" class="form-control" placeholder="Name">--}}
                                                                            {{--</div>--}}
                                                                            {{--<input type="hidden" name="lead_id" value="{{ $quotation->lead_id }}">--}}
                                                                            {{--<input type="hidden" name="quotation_id" value="{{ $quotation->id }}">--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="good_type_id">Cargo Type</label>--}}
                                                                                {{--<select name="good_type_id" id="good_type_id" required class="form-control">--}}
                                                                                    {{--<option value="">Select Cargo Types</option>--}}
                                                                                    {{--@foreach($goodtypes as $goodtype)--}}
                                                                                        {{--<option value="{{ $goodtype->id }}">{{ ucwords($goodtype->name) }}</option>--}}
                                                                                    {{--@endforeach--}}
                                                                                {{--</select>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="shipping_type">Shipping Type</label>--}}
                                                                                {{--<select name="shipping_type" id="shipping_type" required class="form-control">--}}
                                                                                    {{--<option value="">Select Shipping Types</option>--}}
                                                                                    {{--<option value="internal">ESL</option>--}}
                                                                                    {{--<option value="external">External Company</option>--}}
                                                                                {{--</select>--}}
                                                                            {{--</div>--}}

                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="description">Cargo Description</label>--}}
                                                                                {{--<textarea name="description" class="form-control" id="description" placeholder="Cargo Description"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div id="con">--}}

                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="t_net_weight">Total Net Weight</label>--}}
                                                                                {{--<input type="number" id="t_net_weight" name="t_net_weight" required class="form-control" placeholder="Total Net Weight">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="t_gross_weight">Total Gross Weight</label>--}}
                                                                                {{--<input type="number" id="t_gross_weight" name="t_gross_weight" required class="form-control" placeholder="Total Gross Weight">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group" id="nocon" hidden>--}}
                                                                                {{--<label for="container_no">Number of Containers</label>--}}
                                                                                {{--<input type="text" id="container_no" name="container_no" class="form-control" placeholder="Number of Containers">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="type">Type</label>--}}
                                                                                {{--<input type="text" id="type" name="type" class="form-control" placeholder="Type">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="seal_no">Seal Number</label>--}}
                                                                                {{--<input type="text" id="seal_no" name="seal_no" class="form-control" placeholder="Seal Number">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="container_id">Container ID</label>--}}
                                                                                {{--<input type="text" id="container_id" name="container_id" required class="form-control" placeholder="Container ID">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                            {{--<label for="case_qty">Case Qty</label>--}}
                                                                            {{--<input type="text" id="case_qty" name="case_qty" required class="form-control" placeholder="Case Qty">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="package">Number of Package</label>--}}
                                                                                {{--<input type="text" id="package" name="package" required class="form-control" placeholder="Number of Package">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="hs_no">HS Number</label>--}}
                                                                                {{--<input type="text" id="hs_no" name="hs_no" class="form-control" placeholder="HS Number">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="shipper">Shipper Details</label>--}}
                                                                                {{--<textarea name="shipper" cols="30" rows="5" class="form-control" id="shipper" placeholder="Shipper Details"></textarea>--}}
                                                                            {{--</div>--}}


                                                                        {{--</div>--}}
                                                                        {{--<div class="col-sm-6">--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="discharge_rate">Cargo Quantity (MT)</label>--}}
                                                                                {{--<input type="number" id="weight" name="weight" value="" required class="form-control" placeholder="Cargo Quantity (MT)">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="discharge_rate">Discharge Rate</label>--}}
                                                                                {{--<input type="number" id="discharge_rate" name="discharge_rate" value="" required class="form-control" placeholder="Discharge Rate">--}}
                                                                            {{--</div>--}}

                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="total_package">Total Number of Package in Words</label>--}}
                                                                                {{--<textarea name="total_package" class="form-control" id="total_package" placeholder="Total Number of Package in Words"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="bl_no">BL NO</label>--}}
                                                                                {{--<input type="text" id="bl_no" name="bl_no" value="" required class="form-control">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="consignee_name">Consignee Name</label>--}}
                                                                                {{--<input type="text" id="consignee_name" name="consignee_name" value="" required class="form-control">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="consignee_tel">Consignee Telephone</label>--}}
                                                                                {{--<input type="text" id="consignee_tel" name="consignee_tel" value="" required class="form-control">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="consignee_email">Consignee Email</label>--}}
                                                                                {{--<input type="text" id="consignee_email" name="consignee_email" value="" required class="form-control">--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="consignee_address">Consignee Address</label>--}}
                                                                                {{--<input type="text" id="consignee_address" name="consignee_address" value="" required class="form-control">--}}
                                                                            {{--</div>--}}

                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="shipping_line">Shipping Lines</label>--}}
                                                                                {{--<textarea name="shipping_line" class="form-control" id="shipping_line" placeholder="Shipping Lines"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="notifying_address">Notifying Address</label>--}}
                                                                                {{--<textarea name="notifying_address" cols="30" rows="5" class="form-control" id="notifying_address" placeholder="Notifying Address"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="remarks">Remarks</label>--}}
                                                                                {{--<textarea name="remarks" cols="30" rows="5" class="form-control" id="remarks" placeholder="Remarks"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<br>--}}
                                                                                {{--<input class="btn btn-block btn-primary" type="submit" value="Save">--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</form>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="modal-footer">--}}
                                                            {{--<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<!-- /.modal-content -->--}}
                                                {{--</div>--}}
                                                {{--<!-- /.modal-dialog -->--}}
                                            {{--</div>--}}
                                                {{--<table class="table table-striped">--}}
                                                    {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Cargo</th>--}}
                                                        {{--<th>Cargo Type</th>--}}
                                                        {{--<th>Weight</th>--}}
                                                        {{--<th>Discharge Rate</th>--}}
                                                        {{--<th>Consignee</th>--}}
                                                        {{--<th>Action</th>--}}
                                                    {{--</tr>--}}
                                                    {{--</thead>--}}
                                                    {{--<tbody>--}}
                                                    {{--@foreach($quotation->cargos as $cargo)--}}
                                                        {{--<tr>--}}
                                                            {{--<td>{{ ucwords($cargo->name) }}</td>--}}
                                                            {{--<td>{{ ucfirst($cargo->goodType->name )}}</td>--}}
                                                            {{--<td>{{ ucwords($cargo->weight) }}</td>--}}
                                                            {{--<td>{{ ucwords($cargo->discharge_rate) }}</td>--}}
                                                            {{--<td>{{ $cargo->consignee != null ? ucwords($cargo->consignee->consignee_name) : '' }}</td>--}}
                                                            {{--<td>--}}
                                                                {{--<button data-toggle="modal" data-target=".bs-example-modal-lg{{$cargo->id}}" class="btn btn-xs btn-primary">--}}
                                                                    {{--<i class="fa fa-pencil"></i>--}}
                                                                {{--</button>--}}
                                                                {{--<div class="modal fade bs-example-modal-lg{{$cargo->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">--}}
                                                                    {{--<div class="modal-dialog modal-lg">--}}
                                                                        {{--<div class="modal-content">--}}
                                                                            {{--<div class="modal-header">--}}
                                                                                {{--<h4 class="modal-title" id="myLargeModalLabel">Edit Cargo</h4>--}}
                                                                                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="modal-body">--}}
                                                                                {{--<div class="col-12">--}}
                                                                                    {{--<form class="form-material m-t-40" onsubmit="event.preventDefault(); submitForm(this,'/update-cargo-details')" method="post" id="cargo{{$cargo->id}}">--}}
                                                                                        {{--<div class="row">--}}
                                                                                            {{--<div class="col-sm-6">--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="name">Cargo Name</label>--}}
                                                                                                    {{--<input type="text" required  value="{{ $cargo->name }}" id="name" name="name" class="form-control" placeholder="Name">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<input type="hidden" name="cargo_id" value="{{ $cargo->id }}">--}}
                                                                                                {{--<input type="hidden" name="lead_id" value="{{ $cargo->lead_id }}">--}}
                                                                                                {{--<input type="hidden" name="quotation_id" value="{{ $cargo->quotation_id }}">--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="goodtype_id">Cargo Type</label>--}}
                                                                                                    {{--<select name="goodtype_id" id="goodtype_id" required class="form-control">--}}
                                                                                                        {{--<option value="">Select Cargo Types</option>--}}
                                                                                                        {{--@foreach($goodtypes as $goodtype)--}}
                                                                                                            {{--<option {{ $cargo->good_type_id == $goodtype->id ? 'selected' : '' }} value="{{ $goodtype->id}}">{{ ucwords($goodtype->name) }}</option>--}}
                                                                                                        {{--@endforeach--}}
                                                                                                    {{--</select>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="shipping_type">Shipping Type</label>--}}
                                                                                                    {{--<select name="shipping_type" id="shipping_type" required class="form-control">--}}
                                                                                                        {{--<option value="">Select Shipping Types</option>--}}
                                                                                                        {{--<option {{ $cargo->shipping_type == 'internal' ? 'selected' : '' }}value="internal">ESL</option>--}}
                                                                                                        {{--<option {{ $cargo->shipping_type == 'external' ? 'selected' : '' }}value="external">External Company</option>--}}
                                                                                                    {{--</select>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="description">Cargo Description</label>--}}
                                                                                                    {{--<textarea name="description" class="form-control" id="description" placeholder="Cargo Description">{{ $cargo->description }}</textarea>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="t_net_weight">Total Net Weight</label>--}}
                                                                                                    {{--<input type="number"  value="{{ $cargo->t_net_weight }}" id="t_net_weight" name="t_net_weight" required class="form-control" placeholder="Total Net Weight">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="t_gross_weight">Total Gross Weight</label>--}}
                                                                                                    {{--<input type="number" value="{{ $cargo->t_gross_weight }}" id="t_gross_weight" name="t_gross_weight" required class="form-control" placeholder="Total Gross Weight">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="type">Type</label>--}}
                                                                                                    {{--<input type="text" id="type" value="{{ $cargo->type }}" name="type" required class="form-control" placeholder="Type">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--@if($cargo->good_type_id == 1)--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="seal_no">Seal Number</label>--}}
                                                                                                    {{--<input type="text" id="seal_no" value="{{ $cargo->seal_no }}" name="seal_no" class="form-control" placeholder="Seal Number">--}}
                                                                                                {{--</div>--}}

                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="container_id">Container ID</label>--}}
                                                                                                    {{--<input type="text" id="container_id" value="{{ $cargo->container_id }}" name="container_id" class="form-control" placeholder="Container ID">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--@endif--}}
                                                                                            {{--</div>--}}
                                                                                            {{--<div class="col-sm-6">--}}

                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="case_qty">Case Qty</label>--}}
                                                                                                    {{--<input type="text" id="case_qty" value="{{ $cargo->case_qty }}" name="case_qty" required class="form-control" placeholder="Case Qty">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="package">Number of Package</label>--}}
                                                                                                    {{--<input type="text" id="package" value="{{ $cargo->package }}" name="package" required class="form-control" placeholder="Number of Package">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="weight">Cargo Quantity (MT)</label>--}}
                                                                                                    {{--<input type="number" id="weight" value="{{ $cargo->weight }}" name="weight" required class="form-control" placeholder="Cargo Quantity (MT)">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="discharge_rate">Discharge Rate</label>--}}
                                                                                                    {{--<input type="number" id="discharge_rate" value="{{ $cargo->discharge_rate }}" name="discharge_rate" required class="form-control" placeholder="Discharge Rate">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="total_package">Total Number of Package in Words</label>--}}
                                                                                                    {{--<textarea name="total_package" class="form-control" id="total_package" placeholder="Total Number of Package in Words">{{ $cargo->total_package }}</textarea>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="shipper">Shipper Details</label>--}}
                                                                                                    {{--<textarea name="shipper" class="form-control" id="shipper" required placeholder="Shipper Details">{{ $cargo->shipper }}</textarea>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="notifying_address">Notifying Address</label>--}}
                                                                                                    {{--<textarea name="notifying_address" class="form-control" required id="notifying_address" placeholder="Notifying Address">{{ $cargo->notifying_address }}</textarea>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="remarks">Remarks</label>--}}
                                                                                                    {{--<textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks">{{ $cargo->remarks }}</textarea>--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<br>--}}
                                                                                                    {{--<input class="btn btn-block btn-primary" type="submit" value="Update">--}}
                                                                                                {{--</div>--}}
                                                                                            {{--</div>--}}
                                                                                        {{--</div>--}}
                                                                                    {{--</form>--}}

                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="modal-footer">--}}
                                                                                {{--<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}

                                                                {{--<button onclick="deleteItem('{{ $cargo->id }}', '/delete-cargo')" class="btn btn-xs btn-danger">--}}
                                                                    {{--<i class="fa fa-trash"></i>--}}
                                                                {{--</button>--}}
                                                                {{--@if($cargo->consignee->quotation_id == null)--}}
                                                                {{--<a href="{{ url('/proforma/'.$cargo->consignee->id) }}" class="btn btn-xs btn-warning">--}}
                                                                        {{--<i class="fa fa-money"></i>--}}
                                                                {{--</a>--}}
                                                                {{--@else--}}
                                                                    {{--<a href="{{ url('/proforma/'.$cargo->consignee->id) }}" class="btn btn-xs btn-success">--}}
                                                                        {{--<i class="fa fa-check"></i>--}}
                                                                    {{--</a>--}}
                                                                {{--@endif--}}

                                                            {{--</td>--}}
                                                        {{--</tr>--}}
                                                        {{--@endforeach--}}
                                                    {{--</tbody>--}}
                                                {{--</table>--}}
                                        {{--</div>--}}
                                        {{--<div class="tab-pane p-20" id="messages" role="tabpanel">--}}
                                            {{--<h3 class="text-center">Voyage Details</h3>--}}
                                            {{--@if($quotation->voyage == null)--}}
                                                {{--<form class="m-t-40" onsubmit="event.preventDefault();submitForm(this, '/voyage-details','redirect');" action="" id="voyage">--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-sm-6">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<input type="hidden" name="quotation_id" value="{{ $quotation->id }}">--}}
                                                                {{--<label for="name">Voyage Name</label>--}}
                                                                {{--<input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace("MV ","",$quotation->vessel->name))->getName()}}" id="name" name="name" class="form-control" placeholder="Name">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="voyage_no">External Voyage Number</label>--}}
                                                                {{--<input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace("MV ","",$quotation->vessel->name))->getName()}}"  id="voyage_no" name="voyage_no" class="form-control" placeholder="Voyage Number">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="internal_voyage_no">Internal Voyage No</label>--}}
                                                                {{--<input type="text"  id="internal_voyage_no" name="internal_voyage_no" value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace("MV ","",$quotation->vessel->name))->getName()}}" class="form-control" placeholder="Internal Voyage No">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="service_code">Service Code</label>--}}
                                                                {{--<input type="hidden"  id="service_code" value="CODE" name="service_code" class="form-control" placeholder="Service Code">--}}
                                                            {{--</div>--}}


                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-6">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="final_destination">Final Destination </label>--}}
                                                                {{--<input type="text" required id="final_destination" name="final_destination" class="form-control" placeholder="Final Destination">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="eta"> ETA</label>--}}
                                                                {{--<input type="text" required id="eta"  name="eta" class="form-control datepicker">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}

                                                                {{--<label for="vessel_arrived"> Vessel Arrived(ATA)</label>--}}
                                                                {{--<input type="text" required id="vessel_arrived"  name="vessel_arrived" class="form-control datepicker">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<br>--}}
                                                                {{--<input class="btn pull-right btn-primary" type="submit" value="Save">--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                            {{--@else--}}
                                                {{--<div class="row">--}}
                                                    {{--<table class="table table-stripped">--}}
                                                        {{--<tbody>--}}
                                                        {{--<tr>--}}
                                                            {{--<td><strong>Name : </strong>{{ ucwords($quotation->voyage->name )}}</td>--}}
                                                            {{--<td><strong>Voyage NO : </strong> {{ strtoupper($quotation->voyage->voyage_no) }}</td>--}}
                                                            {{--<td><strong>Service Code : </strong> {{ strtoupper($quotation->voyage->service_code) }}</td>--}}
                                                        {{--</tr>--}}
                                                        {{--<tr>--}}
                                                            {{--<td><strong>Final Destination : </strong>{{ ucwords($quotation->voyage->final_destination )}}</td>--}}
                                                            {{--<td><strong>ETA : </strong> {{ \Carbon\Carbon::parse($quotation->voyage->eta)->format('d-M-y') }}</td>--}}
                                                            {{--<td><strong>Vessel Arrived : </strong> {{ \Carbon\Carbon::parse($quotation->voyage->vessel_arrived)->format('d-M-y')}}</td>--}}
                                                        {{--</tr>--}}
                                                        {{--</tbody>--}}
                                                    {{--</table>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
{{--                            @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)--}}
                            <h3>Add Tariff Service | <code style="color: green" id="currency"></code> <span id="notification" class="pull-right" style="overflow: hidden"></span></h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select name="tariff" onchange="perday(this)" required id="tariff" class="form-control select2" data-placeholder="Search and select tariff">
                                                    <option value="">Search and select tariff</option>
                                                    @foreach($tariffs as $tariff)
                                                        <option value="{{$tariff}}">{{ ucwords($tariff->name) }} ~ SP USD {{ $tariff->rate }}  @ {{$tariff->unit_value}} PER {{ ucwords($tariff->unit) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="number" required id="service_units" name="service_units" placeholder="Units" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="number" required id="agency_sp" name="agency_sp" placeholder="Selling Price" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select name="tax" required id="tax" class="form-control select2" data-placeholder="Select tax">
                                                    <option value="">Select tax</option>
                                                    @foreach($taxs as $tax)
                                                        <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-block btn-sm btn-primary" onclick="addTariff()"><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                        <tr>
                                        <tr>
                                            <th>Description</th>
                                            <th class="text-left">GRT/LOA</th>
                                            <th class="text-right">RATE</th>
                                            <th class="text-right">UNITS</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Total (Incl)</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </tr>
                                        </thead>
                                        <tbody id="service">
                                        </tbody>
                                    </table>
                                    <button onclick="addServiceToQuotaion()" class="btn btn-primary pull-right">Add Service</button>
                                </div>
                            </div>
                            {{--@endif--}}

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-left">GRT/LOA</th>
                                    <th class="text-right">RATE</th>
                                    <th class="text-right">UNITS</th>
                                    <th class="text-right">Tax</th>
                                    <th class="text-right">Total (Incl)</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="q_service">
                                @if($quotation != null)
                                @foreach($quotation->services as $service)
                                    <tr>
                                        <td>{{ ucwords($service->description) }}</td>
                                        <td class="text-left">{{ $service->grt_loa }}</td>
                                        <td class="text-right">{{ $service->agency_sp }}</td>
                                        <td class="text-right">{{ $service->units }}</td>
                                        <td class="text-right">{{ $service->tax_amount }}</td>
                                        <td class="text-right">{{ number_format($service->total,2) }}</td>
                                        <td class="text-right">
                                            <button data-toggle="modal" data-target=".bs-example-modal-lg{{$service->id}}" class="btn btn-xs btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <div class="modal fade bs-example-modal-lg{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Edit Service</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <form style="text-align: left !important;" id="update_service{{$service->id}}" onsubmit="event.preventDefault(); submitForm(this, '/update-service');" action="" method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="description text-left">Description</label>
                                                                                        <input type="text" value="{{ ucwords($service->description) }}" required id="description" name="description" class="form-control" placeholder="Description">
                                                                                    </div>
                                                                                    <input type="hidden" value="proforma" name="type">
                                                                                    <div class="form-group">
                                                                                        <label for="grt_loa">GRT/LOA</label>
                                                                                        <input type="text" required id="grt_loa" value="{{ $service->grt_loa  }}" name="grt_loa" class="form-control" placeholder="GRT/LOA" readonly>
                                                                                    </div>
                                                                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                                                    <input type="hidden" name="tariff_type" value="{{ $service->tariff->type }}">
                                                                                    <div class="form-group">
                                                                                        <label for="rate">Rate </label>
                                                                                        <input type="text" readonly required id="rate" value="{{ $service->rate }}" name="rate" class="form-control" placeholder="Rate">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="rate">Selling Price </label>
                                                                                        <input type="text" required id="agency_sp" {{ $service->tariff->type == \Esl\helpers\Constants::TARIFF_KPA ? 'readonly' : ' ' }} value="{{ $service->agency_sp }}" name="agency_sp" class="form-control" placeholder="Selling Price">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="units">Units </label>
                                                                                        <input type="text" required id="units" name="units" value="{{ $service->units }}" class="form-control" placeholder="Units">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="tax">Tax Rate</label>
                                                                                        <select name="tax" required id="tax" style="width: 100% !important;" class="form-control select2">
                                                                                            @foreach($taxs as $tax)
                                                                                                <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <br>
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Update">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                            <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        </tr>
                                @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p id="sub_ex"><b>Total (Excl)</b> {{$quote->lead->currency }} : {{$quotation == null ? 0 :   number_format(($quotation->services->sum('total') - $quotation->services->sum('tax')),2) }}</p>
                            <p id="total_tax"><b>Tax</b> {{$quote->lead->currency }} : {{$quotation == null ? 0 :   number_format($quotation->services->sum('tax'),2) }} </p>
                            <p id="sub_in"><b>Total (Incl)</b> {{$quote->lead->currency }} : {{ $quotation == null ? 0 :  number_format($quotation->services->sum('total'),2) }} </p>
                            <hr>
                            {{--<h3 id="total_amount">Balance (Incl) {{$quotation->lead->currency }} : {{ $quotation == null ? 0 :  number_format(($quotation->services->sum('total') - $quotation->remittance),2) }}</h3>--}}
                            {{--<form class="form-inline" action="">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="remittance">Remittance</label>--}}
                                    {{--<input type="number" name="remittance" id="remittance" placeholder="Remittance Amount in {{$quotation->lead->currency}}" class="form-control">--}}
                                {{--</div>--}}
                                {{--<button type="button" onclick="addRemittance()" class="btn btn-primary">Add Remittance</button>--}}
                                {{--<button type="button" onclick="reduceRemittance()" class="btn btn-danger">Reduce Remittance</button>--}}
                            {{--</form>--}}
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        {{--<form action="" method="post" onsubmit="event.preventDefault();submitForm(this, '/notifying','redirect');" id="notifying">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--@if($quotation->parties != null)--}}
                                    {{--@foreach(json_decode($quotation->parties->emails) as $party)--}}
                                        {{--<b>{{$loop->iteration}}. </b> {{ $party }}--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                                    {{--<br>--}}
                                    {{--<br>--}}
                            {{--</div>--}}
                                {{--<div class="col-sm-3">Add Emails to CC</div>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<input type="hidden" name="quotation_id" value="{{$quotation->id}}">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input type="text" name="notifying" placeholder="Add emails here separate with (,) " class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-3">--}}
                                    {{--<button type="submit" class="btn btn-primary pull-right">Add Emails</button>--}}
                                {{--</div>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--<hr>--}}
                        {{--<div class="col-sm-12">--}}

                            {{--<h3>Remarks</h3>--}}
                            {{--<table class="table table-responsive">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Name</th>--}}
                                    {{--<th>Remarks</th>--}}
                                    {{--<th class="text-right">Date</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($quotation->remarks->sortByDesc('created_at') as $remark)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ ucwords($remark->user->name) }}</td>--}}
                                        {{--<td>{{ ucfirst($remark->remark) }}</td>--}}
                                        {{--<td class="text-right">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-y') }}</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12">--}}
                            {{--<form id="pda_remarks_form" action="" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="remarks">Remarks</label>--}}
                                    {{--<textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>--}}
                                {{--</div>--}}
                                {{--<input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-12">--}}
                                        {{--<button class="btn btn-primary pull-right"  onclick="event.preventDefault(); remark()">Add remark</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        <div class="text-right">
                            @if($quotation != null)
                                <a target="_blank" href="{{ url('/proforma/download/'.$quotation->id) }}" class="btn btn btn-outline-success">Download</a>
                                <button data-toggle="modal" data-target=".bs-example-modal-client" class="btn btn btn-outline-success">
                                    Send To Client
                                </button>
                                <div class="modal fade bs-example-modal-client" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Message Body</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <form action="{{ url('/client/quotation/send/') }}" method="post">
                                                        <div class="row">
                                                            {{ csrf_field() }}
                                                            <div class="col-sm-12">
                                                                <input type="hidden" name="quotation_id" value="{{$quotation == null ? ' ' : $quotation->id}}">
                                                                <div class="form-group">
                                                                    <input type="text" required id="subject" name="subject" class="form-control"
                                                                           placeholder="Subject">
                                                                </div>
                                                                <input type="hidden" name="type" value="proforma">
                                                                <div class="form-group">
                                                                    <input type="email" value="" required id="email" name="email" class="form-control"
                                                                           placeholder="Client Email">
                                                                </div>
                                                                <div class="form-group">
                                                                                <textarea name="message" required id="summary-ckeditor" cols="30"
                                                                                          rows="10" placeholder="Message"
                                                                                          class="form-control"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input class="btn pull-right  btn btn-outline-success" type="submit" value="Send To Customer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--<a href="{{ url('/quotation/send/'.$quotation->id) }}" class="btn btn btn-outline-success">Send To Customer</a>--}}
                            {{--@endif--}}
                                {{--@if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)--}}
                                {{--<a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Accepted</a>--}}
                                {{--<a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" class="btn btn-danger" type="submit"> Declined </a>--}}
                                {{--@endif--}}
                                {{--@if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)--}}
                                {{--<a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Start Processing</a>--}}
                                {{--@endif--}}
{{--                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Archive</a>--}}
                                {{--<a target="_blank" href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>--}}
                                {{--@if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED--}}
                            {{--&& $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)--}}
                                {{--<a href="{{ url('/quotation/request/'.$quotation->id) }}" class="btn btn-success" type="submit"> Request Approval </a>--}}
                                    {{--@endif--}}
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var search_item = $('#customer');
        var display_search = $('#display');
        search_item.on('keyup', function () {

            if(search_item.val() == "") {
                display_search.html("")
            }
            else {
                axios.post('/search-customer', {'customer' : 'customer','search_item' : search_item.val()})
                    .then( function (response) {
                        display_search.empty().append(response.data.output);
                    })
                    .catch( function (response) {
                        console.log(response.data);
                    });
            }
        });

        function fillData(dclink) {
            axios.get('{{ url('/get-customer') }}/' + dclink)
                .then( function (response) {
                    var customer = response.data.customer;

                    $('#add_customer').hide();
                    $('#client_details').empty().append(
                        '<div class="col-sm-12"><h4><b>To</b></h4>'+
                        '<h4 id="client-name"> Name : ' + customer.Name + '</h4>'+
                        '<h4 id="contact-person">Contact Person : ' + customer.Contact_Person + '</h4>'+
                        '<h4 id="contact-phone">Phone : ' + customer.Telephone + '</h4>'+
                        '<h4 id="contact-email">Email : ' + customer.EMail + '</h4></div>'+
                        '<h4 id="contact-currency">Currency : ' + (customer.iCurrencyID == 1 ? 'USD' : 'KES') + '</h4></div>'
                    );

                    this.data.lead_id = customer.DCLink;

                    if(this.data.currency === "" || this.data.currency === null){
                        this.data.currency = (customer.iCurrencyID == 1 ? 'USD' : 'KES');
                    }
                    console.log(dclink, this.data.currency)

                    $('#currency').empty().append('CURRENCY ' + this.data.currency);

                })
                .catch( function (response) {
                    console.log(response.data);
                });

            this.data.DCLink = dclink;
            display_search.empty();
        }

        var containerType = $('#good_type_id');
        var thediv = $('#con');
        containerType.on('change', function () {
            console.log(containerType.find(":selected").val());
            if(containerType.find(":selected").val() == 1){
                var inputboxes = '<div class="form-group">' +
                    '<label for="container_no">Number of Containers</label>' +
                    '<input type="text" id="container_no" name="container_no" class="form-control" placeholder="Number of Containers">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="volume">Volume (Cubic meter)</label>' +
                    '<input type="text" id="volume" name="volume" class="form-control" placeholder="Volume (Cubic meter)">' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label for="type">Container Type</label>' +
                    '<select name="type" id="type" required class="form-control">';
                @foreach($containertypes as $containertype)
                    inputboxes = inputboxes + '<option value="{{$containertype->name}}">{{$containertype->name}}</option>';
                    @endforeach

                        inputboxes = inputboxes + '</select></div>'+
                    '<div class="form-group" style="margin-top: 40px">' +
                    '<label for="seal_no">Seal Number</label>' +
                    '<input type="text" id="seal_no" name="seal_no" class="form-control">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="container_id">Container No</label>' +
                    '<input type="text" id="container_id" name="container_id" class="form-control">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="container_size">Container Size</label>' +
                    '<input type="text" id="container_size" name="container_size" class="form-control">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="load_status">Load Status</label>' +
                    '<input type="text" id="load_status" name="load_status" class="form-control">' +
                    '</div>'
                ;

                thediv.empty().append(inputboxes);

            }
            else {

//                contractValue.val('');
                thediv.empty().append(
                    '<div class="form-group">' +
                    '<label for="type">Non Conventional Cargo Type</label>' +
                    '<select name="type" id="type" required class="form-control">'+
                    '<option>Select Cargo Type</option>'+
                    '<option value="Animal">Animal</option>'+
                    '<option value="Bulk">Bulk</option>'+
                    '<option value="Bulk Liquid">Bulk Liquid</option>'+
                    '<option value="General Cargo">General Cargo</option>'+
                    '<option value="Motor Vehicle">Motor Vehicle</option>' +
                        '</select></div>'
            );

            }
        });

        var form = $('#pda_remarks_form');
        var currency = '{{$quote->lead->currency }}';

        function remark() {
            var formData = form.serializeArray().reduce(function (obj, item){
                obj[item.name] = item.value;
                return obj;
            }, {});

            submitData(formData,'/agency/remark')
        }

        function submitData(data, formUrl) {
            console.log(data);
            axios.post('{{ url('/') }}' + formUrl, data)
                .then(function (response) {
                    console.log(response.data)
                    window.location.reload();
                })
                .catch(function (response) {
                    console.log(response.data);
                });
        }

        var vessel = $('#vessel');
        vessel.on('submit', function (e) {
            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            axios.post('{{ url('/vessel-details') }}', data)
                .then(function (response) {
                    window.location.reload();
                    var details = response.data.success;
                    $('#port').empty().append("<b>Port : </b> " + details.port_of_discharge);
                    $('#loa').empty().append("<b>LOA : </b> " + details.loa + " M");
                    $('#grt').empty().append("<b>GRT : </b> " + details.grt + " GT");
                    $('#vessel_name').empty().append("<b>Vessel : </b>" + details.vessel_name);
                    $('#vessel').empty().append("<h4><b>Vessel Details Updated</b></h4>");
                })
                .catch(function (response) {
                    console.log(response.data);
                });
            e.preventDefault();
        });

        var data = {
            'grt' : '{{ $quote->vessel->grt }}',
            'loa' : '{{ $quote->vessel->loa }}',
            'currency' : '{{ $quotation == null ? '' : $quotation->currency}}',
            'consignee_id' : '{{ $consignee->id}}',
            'type':'proforma',
            'lead_id':'{{ $quotation == null ? '' : $quotation->lead_id }}',
            '_token' : '{{ csrf_token() }}',
            'c_weight' : '{{ count($quote->cargos) < 1 ? 0 : $quote->cargos->sum('weight') }}',
            'proforma' : '{{ $quotation == null ? '' : $quotation->id }}',
            'port_stay' : '{{ count($quote->cargos) < 1 ? 0 : ( ceil(($quote->cargos->sum('weight'))/$quote->cargos->first()->discharge_rate) )}}',
            'service': {}
        };

        $('#currency').empty().append('CURRENCY ' + this.data.currency);

        function addConsigneeDetails(lead) {
            console.log(lead);
        }

        function addRemittance() {
            var remittanceAmount = $('#remittance').val();

            if(remittanceAmount !== '' && remittanceAmount !== null ){
                axios.post('{{ url('/add-remittance') }}',
                    {'amount' : remittanceAmount
                , 'quotation_id':this.data.quotation
                    })
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
            else {
                alert('No Remittance Amount Added');
            }
        }

        function reduceRemittance() {
            var remittanceAmount = $('#remittance').val();

            if(remittanceAmount !== '' && remittanceAmount !== null ){
                axios.post('{{ url('/reduce-remittance') }}', {'amount': remittanceAmount,
                    'quotation_id': this.data.quotation})
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
            else {
                alert('No Remittance Amount Added');
            }
        }

        function addTariff() {
            console.log('here');
            var agency_sp = 0;
            var checkIt = 0;

            if($('#tariff').val() === "" || $('#tariff').val() === null){
                alert('Select One Service');
                return true;
            }

            if($('#tax').val() === "" || $('#tax').val() === null){
                alert('Select Tax');
                return true;
            }

            var selected = document.getElementById("tariff");
            var selectedTariff = JSON.parse(selected.options[selected.selectedIndex].value);

            var sTax = document.getElementById("tax");
            var selectedTax = JSON.parse(sTax.options[sTax.selectedIndex].value);

            var units = $('#service_units').val();

            agency_sp = $('#agency_sp').val();
            checkIt = parseFloat(agency_sp);

            if(units === "" || units === null){
                alert('Enter Unit');
            }

            else if (agency_sp === "" || agency_sp === null){
                alert('Enter Selling Price');
            }

            else if(selectedTariff.rate > checkIt ){
                alert('Selling Price Cannot Be Below Buying Price');
            }

            else {

                //            Calculation using grt/loa
                if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT }}'){

                    var  grt_loa = Math.ceil(parseFloat(this.data.grt) / parseFloat(selectedTariff.unit_value));
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : ((parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === "Per Unit"){

                    var  grt_loa = "Per Mt";
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    console.log(this.data.port_stay);
                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100) + (parseFloat(agency_sp)* parseFloat(serviceUnit)))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === 'Thereafter GRT'){

                    var  grt_loa = (Math.ceil(parseFloat(this.data.grt) / parseFloat(selectedTariff.unit_value)) - 100);
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : ((parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === "First GRT"){

                    var  grt_loa = selectedTariff.unit_value;
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) *
                            parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : ((parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA }}'){
                    var  grt_loa = Math.ceil(parseFloat(this.data.loa) / parseFloat(selectedTariff.unit_value));
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100) + (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit)))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM }}'){
                    var  grt_loa = selectedTariff.unit_type;
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    console.log(this.data.port_stay);
                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100) + (parseFloat(agency_sp)* parseFloat(serviceUnit)))
                    }

                    addService(serviceData);
                }

                else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY }}'){
                    var  grt_loa = selectedTariff.unit_type;
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate  * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate  * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100) + (parseFloat(agency_sp)* parseFloat(serviceUnit)))
                    }

                    addService(serviceData);
                }
                else if(selectedTariff.unit_type === "Thereafter Days"){
                    var  grt_loa = selectedTariff.unit_type;
                    var serviceUnit = units === "" ? 0 : (units - 3);
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);
//                $('#service_units').val(selectedTariff.unit_value);
                    var rtt = 2500;

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : 'Agency Fee 1st 3 Days',
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate  * (parseFloat(rtt )* parseFloat(1))) / 100),
                        'grt_loa' : 'Lumpsum',
                        'rate' : rtt,
                        'agency_sp' : rtt,
                        'units' : 1,
                        'total' : (((selectedTax.TaxRate  * (parseFloat(rtt )* parseFloat(1))) / 100) +
                            (parseFloat(rtt )* parseFloat(1)))
                    }
//                var  grt_loa = selectedTariff.unit_type;

                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);
//                $('#service_units').val(selectedTariff.unit_value);
                    var tre = 250;

                    var serviceData2 =  {
                        'id': 'serv'+(Object.keys(this.data.service).length + 2),
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : 'Agency Fee Therafter',
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate  * (parseFloat(tre )* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : 'Per Day',
                        'rate' : tre,
                        'agency_sp' : tre,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate  * (parseFloat(tre )* parseFloat(serviceUnit))) / 100) + (parseFloat(tre )* parseFloat(serviceUnit)))
                    }

                    addService(serviceData);
                    addService(serviceData2);
                }

                else {
                    var  grt_loa = selectedTariff.unit_type;
                    var serviceUnit = units === "" ? 0 : units;
                    var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                    var serviceData =  {
                        'id': newId,
                        'stk_id' : selectedTariff.stk_id,
                        'tariff_id' : selectedTariff.id,
                        'description' : selectedTariff.name,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax_amount' : ((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100),
                        'grt_loa' : grt_loa,
                        'rate' : selectedTariff.rate,
                        'agency_sp' : agency_sp,
                        'units' : serviceUnit,
                        'total' : (((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100) + (parseFloat(agency_sp)* parseFloat(serviceUnit)))
                    }
                    addService(serviceData);
                }
            }
            resetForm();
        }


        function addService(data){
            console.log(data);
            $('#service').append('<tr id="' + data.id + '">' +
                '<td>' + data.description + '</td>' +
                '<td class="text-right">' + data.grt_loa + '</td>' +
                '<td class="text-right">' + Number(data.agency_sp).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(data.units).toFixed(2) + '</td>' +
                '<td class="text-right">' + data.tax_amount +' </td>' +
                '<td class="text-right">' + Number(data.total).toFixed(2)+ '</td>' +
                '<td class="text-right"><button onclick="deleteRow(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.service[data.id] = data;

        }

        function deleteRow(row) {
            var table_row = row.parentNode.parentNode;

            delete this.data.service[table_row.id];
            table_row.parentNode.removeChild(table_row);
        }

        function addServiceToQuotaion() {
            if(Object.keys(this.data.service).length < 1){
                alert('No Service Added');
            }
            else {
                axios.post('{{ url('/quotation-service') }}', this.data)
                    .then(function (response) {
                        window.location.reload();
//                       TODO::validation
                        $('#q_service').empty().append(response.data.success.services);
                        $('#sub_ex').empty().append("Total (Excl) " + this.currency + " : " + response.data.success.exc_total);
                        $('#total_tax').empty().append("Tax " + this.currency + " : " + response.data.success.total_tax);
                        $('#sub_in').empty().append("Total (Incl) " + this.currency + " : " + response.data.success.inc_total);
                        $('#total_amount').empty().append("<b>Total (Incl) " + this.currency + " :</b>  " + response.data.success.inc_total);
                        $('#service').empty();
                        this.data['service'] = {};
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
        }

        function deleteService(id) {
            axios.post('{{ url('/quotation-service-delete') }}', {
                'service_id' : id,
                'quotation_id' : this.data.quotation,
                '_token' : '{{ csrf_token() }}'
            })
                .then(function (response) {
                    window.location.reload();
//                       TODO::validation
                    $('#q_service').empty().append(response.data.success.services);
                    $('#sub_ex').empty().append("Total (Excl) " + this.currency + " : " + response.data.success.exc_total);
                    $('#total_tax').empty().append("Tax " + this.currency + " : " + response.data.success.total_tax);
                    $('#sub_in').empty().append("Total (Incl) " + this.currency + " : " + response.data.success.inc_total);
                    $('#total_amount').empty().append("<b>Total (Incl) " + this.currency + " :</b>  " + response.data.success.inc_total);
                    $('#service').empty();
                    this.data['service'] = {};
                })
                .catch(function (response) {
                    console.log(response);
                });
        }

        function resetForm() {
            $('#tariff').val(1).trigger('change.select2');
            $('#tax').val(1).trigger('change.select2');
            $('#service_units').val('');
            $('#agency_sp').val('').removeAttr('readonly');
        }

        function perday(selected) {

            $('#service_units').removeAttr('readonly').val('');
            $('#agency_sp').removeAttr('readonly').val('');

            if($('#tariff').val() === "" || $('#tariff').val() === null){
                return true;
            }
            else{
                if(JSON.parse($('#'+selected.id).val()).unit_type === 'per day'){
                    $('#service_units').val(this.data.port_stay);
                    $('#service_units').attr('readonly','readonly');
                }
                else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Lumpsum'){
                    $('#service_units').val(1);
                    $('#service_units').attr('readonly','readonly');
                }
                else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Per M'){
                    $('#service_units').val(this.data.c_weight);
                    $('#service_units').attr('readonly','readonly');
                }
                else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Thereafter Days'){
                    $('#service_units').val(this.data.port_stay);
                    $('#service_units').attr('readonly','readonly');
                }
                if(JSON.parse($('#'+selected.id).val()).type === 'kpa'){
                    $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                    $('#agency_sp').attr('readonly','readonly');
                }
                else {
                    $('#service_units').removeAttr('readonly').val('');
                    $('#agency_sp').removeAttr('readonly').val('');
                }
            }
        }

    </script>
@endsection