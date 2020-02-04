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
                <h3 class="text-center">PROFORMA DISBURSEMENT ACCOUNT</h3>
                <br>
                <div class="row">
                    @include('partials.invoice-head')
                    <hr>

                    <div class="card-body wizard-content">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Customer Request Details</h4>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Cargo / Consignee Details</span></a> </li>
                                        <li style="display: none;" class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Details</span></a> </li>
                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="p-20">
                                                <table class="table table-boarded">
                                                    <tr>
                                                        <td><strong>Name : </strong> {{ $quotation->vessel->name }}</td>
                                                        <td><strong>Country : </strong> {{ $quotation->vessel->country }}</td>
                                                        <td><strong>Call Sign : </strong> {{ strtoupper($quotation->vessel->call_sign )}}</td>
                                                        <td><strong>IMO Number : </strong> {{ strtoupper($quotation->vessel->imo_number) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>LOA : </strong> {{ $quotation->vessel->loa }}</td>
                                                        <td><strong>GRT : </strong> {{ $quotation->vessel->grt }}</td>
                                                        <td><strong>Consignee Goods : </strong> {{ $quotation->cargos->sum('weight') }}</td>
                                                        <td><strong>NRT : </strong> {{ $quotation->vessel->nrt }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>DWT : </strong> {{ $quotation->vessel->dwt }}</td>
                                                        <td><strong>Port of Discharge: </strong> {{ $quotation->vessel->port_of_discharge }} , {{ $quotation->vessel->country_of_discharge }}</td>
                                                        <td><strong>Port of Loading: </strong> {{ $quotation->vessel->port_of_loading }} , {{ $quotation->vessel->country_of_loading }}</td>
                                                        <td><strong>ETA : </strong> {{ $quotation->vessel->eta != null ? \Carbon\Carbon::parse($quotation->vessel->eta)->format('d-M-y') : ' ' }}</td>
                                                    </tr>
                                                </table>
                                                <button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-primary">
                                                    Edit Detail
                                                </button>
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Edit</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" onsubmit="event.preventDefault();submitForm(this, '/update-vessel-details','redirect');" method="post" id="vessel">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="hidden" value="{{$quotation->lead_id}}" name="lead_id">
                                                                                    <input type="hidden" value="{{$quotation->vessel->id}}" name="vessel_id">
                                                                                    <label for="name">Vessel Name</label>
                                                                                    <input type="text" required id="name" name="name" value="{{ $quotation->vessel->name }}" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="call_sign">Call Sign</label>
                                                                                    <input type="text"  id="call_sign" name="call_sign" value="{{ $quotation->vessel->call_sign }}" class="form-control" placeholder="HS Code">
                                                                                </div>
                                                                                <input type="hidden" value="{{$quotation->id}}" name="quote_id">
                                                                                <div class="form-group">
                                                                                    <label for="imo_number">IMO Number </label>
                                                                                    <input type="text"  id="imo_number" value="{{ $quotation->vessel->imo_number }}" name="imo_number" class="form-control" placeholder="IMO Number">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="country">Country </label>

                                                                                    <select style="width: 100% !important;" required name="country" id="country"
                                                                                            class="select2 form-control">
                                                                                        <option value="">Select Country</option>
                                                                                        @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                                                            <option {{ $quotation->vessel->country == $value ? 'selected' : ''}} value="{{$value}}">{{$value}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="port_of_discharge"> Port of Loading</label>
                                                                                    <input type="text" id="port_of_discharge" value="{{ $quotation->vessel->port_of_discharge }}" required name="port_of_discharge" class="form-control" placeholder="Port">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="port_of_loading"> Port of Discharge</label>
                                                                                    <input type="text" id="port_of_loading" value="{{ $quotation->vessel->port_of_loading }}" required name="port_of_loading" class="form-control" placeholder="Port">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="loa">Length Over All </label>
                                                                                    <input type="number" id="loa" name="loa" value="{{ $quotation->vessel->loa }}" required class="form-control" placeholder="Lenth Over All">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="grt">Gross Tonnage  GRT</label>
                                                                                    <input type="number" id="grt" name="grt" value="{{ $quotation->vessel->grt }}" required class="form-control" placeholder="Gross Tonnage ">
                                                                                </div>
                                                                                {{--<div class="form-group">--}}
                                                                                    {{--<label for="consignee_good"> Consignee Goods GT </label>--}}
                                                                                    {{--<input type="number" id="consignee_good" value="{{ $quotation->vessel->consignee_good }}" required name="consignee_good" class="form-control" placeholder="Net Tonnage">--}}
                                                                                {{--</div>--}}
                                                                                <div class="form-group">
                                                                                    <label for="nrt"> Net Tonnage</label>
                                                                                    <input type="number" id="nrt" name="nrt"  value="{{ $quotation->vessel->nrt }}" class="form-control" placeholder="Consignee Goods">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nrt"> ETA</label>
                                                                                    <input type="text" id="eta" name="eta"  value="{{ $quotation->vessel->eta }}" class="datepicker form-control">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="dwt"> Dead Weight - including provision</label>
                                                                                    <input type="number" id="dwt" name="dwt"  value="{{ $quotation->vessel->dwt }}" class="form-control" placeholder="Dead Weight - including provision">
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
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                            {{--@if(count($quotation->cargos) < 1)--}}
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lgcargo">Add Details</button>
                                            {{--@endif--}}
                                                <div class="modal fade bs-example-modal-lgcargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Add Details</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <form class="m-t-40" onsubmit="event.preventDefault(); submitForm(this,'/cargo-details')" method="post" id="cargo">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="name">Cargo Name</label>
                                                                                <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                                            </div>
                                                                            <input type="hidden" name="lead_id" value="{{ $quotation->lead_id }}">
                                                                            <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
                                                                            <div class="form-group">
                                                                                <label for="good_type_id">Cargo Type</label>
                                                                                <select name="good_type_id" id="good_type_id" required class="form-control">
                                                                                    <option value="">Select Cargo Types</option>
                                                                                    @foreach($goodtypes as $goodtype)
                                                                                        <option value="{{ $goodtype->id }}">{{ ucwords($goodtype->name) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="shipping_type">Shipping Type</label>
                                                                                <select name="shipping_type" id="shipping_type" required class="form-control">
                                                                                    <option value="">Select Shipping Types</option>
                                                                                    <option value="internal">ESL</option>
                                                                                    <option value="external">External Company</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="description">Cargo Description</label>
                                                                                <textarea name="description" class="form-control" id="description" placeholder="Cargo Description"></textarea>
                                                                            </div>
                                                                            <div id="con">

                                                                            </div>
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
                                                                            <div class="form-group">
                                                                                <label for="package">Number of Package</label>
                                                                                <input type="text" id="package" name="package" required class="form-control" placeholder="Number of Package">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="hs_no">HS Number</label>
                                                                                <input type="text" id="hs_no" name="hs_no" class="form-control" placeholder="HS Number">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="shipper">Shipper Details</label>
                                                                                <textarea name="shipper" cols="30" rows="5" class="form-control" id="shipper" placeholder="Shipper Details"></textarea>
                                                                            </div>


                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="discharge_rate">Cargo Quantity (MT)</label>
                                                                                <input type="number" id="weight" name="weight" value="" required class="form-control weight" placeholder="Cargo Quantity (MT)">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="discharge_rate">Discharge Rate</label>
                                                                                <input type="number" id="discharge_rate" name="discharge_rate" value="" required class="form-control discharge_rate" placeholder="Discharge Rate">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="total_package">Total Number of Package in Words</label>
                                                                                <textarea name="total_package" class="form-control" id="total_package" placeholder="Total Number of Package in Words"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="bl_no">BL NO</label>
                                                                                <input type="text" id="bl_no" name="bl_no" value="" required class="form-control">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="consignee_name">Consignee Name</label>
                                                                                <input type="text" id="consignee_name" name="consignee_name"  class="form-control" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="consignee_tel">Consignee Telephone</label>
                                                                                <input type="text" id="consignee_tel" name="consignee_tel"  class="form-control">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="consignee_email">Consignee Email</label>
                                                                                <input type="text" id="consignee_email" name="consignee_email" class="form-control">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="consignee_address">Consignee Address</label>
                                                                                <textarea name="consignee_address" cols="30" rows="5" class="form-control" id="consignee_address"
                                                                                          placeholder="Consignee Address"></textarea>
                                                                            </div>

                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label for="shipping_line">Shipping Lines</label>--}}
                                                                                {{--<textarea name="shipping_line" class="form-control" id="shipping_line" placeholder="Shipping Lines"></textarea>--}}
                                                                            {{--</div>--}}
                                                                            <div class="form-group">
                                                                                <label for="notifying_address">Notifying Address</label>
                                                                                <textarea name="notifying_address" cols="30" rows="5" class="form-control" id="notifying_address" placeholder="Notifying Address"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="remarks">Remarks</label>
                                                                                <textarea name="remarks" cols="30" rows="5" class="form-control" id="remarks" placeholder="Remarks"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <br>
                                                                                <input class="btn btn-block btn-primary" type="submit" value="Save">
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
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Cargo</th>
                                                        <th>Cargo Type</th>
                                                        <th>Weight</th>
                                                        <th>Discharge Rate</th>
                                                        <th>Consignee</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($quotation->cargos as $cargo)
                                                        <tr>
                                                            <td>{{ ucwords($cargo->name) }}</td>
                                                            <td>{{ ucfirst($cargo->goodType->name )}}</td>
                                                            <td>{{ ucwords($cargo->weight) }}</td>
                                                            <td>{{ ucwords($cargo->discharge_rate) }}</td>
                                                            <td>{{ $cargo->consignee != null ? ucwords($cargo->consignee->consignee_name) : '' }}</td>
                                                            <td>
                                                                <button data-toggle="modal" data-target=".bs-example-modal-lg{{$cargo->id}}" class="btn btn-xs btn-primary">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                                <div class="modal fade bs-example-modal-lg{{$cargo->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myLargeModalLabel">Edit Cargo</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-12">
                                                                                    <form class="form-material m-t-40" onsubmit="event.preventDefault(); submitForm(this,'/update-cargo-details')" method="post" id="cargo{{$cargo->id}}">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="name">Cargo Name</label>
                                                                                                    <input type="text" required  value="{{ $cargo->name }}" id="name" name="name" class="form-control" placeholder="Name">
                                                                                                </div>
                                                                                                <input type="hidden" name="cargo_id" value="{{ $cargo->id }}">
                                                                                                <input type="hidden" name="lead_id" value="{{ $cargo->lead_id }}">
                                                                                                <input type="hidden" name="quotation_id" value="{{ $cargo->quotation_id }}">
                                                                                                <div class="form-group">
                                                                                                    <label for="goodtype_id">Cargo Type</label>
                                                                                                    <select name="goodtype_id" id="goodtype_id" required class="form-control">
                                                                                                        <option value="">Select Cargo Types</option>
                                                                                                        @foreach($goodtypes as $goodtype)
                                                                                                            <option {{ $cargo->good_type_id == $goodtype->id ? 'selected' : '' }} value="{{ $goodtype->id}}">{{ ucwords($goodtype->name) }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipping_type">Shipping Type</label>
                                                                                                    <select name="shipping_type" id="shipping_type" required class="form-control">
                                                                                                        <option value="">Select Shipping Types</option>
                                                                                                        <option {{ $cargo->shipping_type == 'internal' ? 'selected' : '' }}value="internal">ESL</option>
                                                                                                        <option {{ $cargo->shipping_type == 'external' ? 'selected' : '' }}value="external">External Company</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="description">Cargo Description</label>
                                                                                                    <textarea name="description" class="form-control" id="description" placeholder="Cargo Description">{{ $cargo->description }}</textarea>
                                                                                                </div>
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="t_net_weight">Total Net Weight</label>--}}
                                                                                                    {{--<input type="number"  value="{{ $cargo->t_net_weight }}" id="t_net_weight" name="t_net_weight" required class="form-control" placeholder="Total Net Weight">--}}
                                                                                                {{--</div>--}}
                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="t_gross_weight">Total Gross Weight</label>--}}
                                                                                                    {{--<input type="number" value="{{ $cargo->t_gross_weight }}" id="t_gross_weight" name="t_gross_weight" required class="form-control" placeholder="Total Gross Weight">--}}
                                                                                                {{--</div>--}}
                                                                                                <div class="form-group">
                                                                                                    <label for="type">Type</label>
                                                                                                    <input type="text" id="type" value="{{ $cargo->type }}" name="type" required class="form-control" placeholder="Type">
                                                                                                </div>
                                                                                                @if($cargo->good_type_id == 1)
                                                                                                <div class="form-group">
                                                                                                    <label for="seal_no">Seal Number</label>
                                                                                                    <input type="text" id="seal_no" value="{{ $cargo->seal_no }}" name="seal_no" class="form-control" placeholder="Seal Number">
                                                                                                </div>

                                                                                                <div class="form-group">
                                                                                                    <label for="container_id">Container ID</label>
                                                                                                    <input type="text" id="container_id" value="{{ $cargo->container_id }}" name="container_id" class="form-control" placeholder="Container ID">
                                                                                                </div>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-sm-6">

                                                                                                {{--<div class="form-group">--}}
                                                                                                    {{--<label for="case_qty">Case Qty</label>--}}
                                                                                                    {{--<input type="text" id="case_qty" value="{{ $cargo->case_qty }}" name="case_qty" required class="form-control" placeholder="Case Qty">--}}
                                                                                                {{--</div>--}}
                                                                                                <div class="form-group">
                                                                                                    <label for="package">Number of Package</label>
                                                                                                    <input type="text" id="package" value="{{ $cargo->package }}" name="package" required class="form-control" placeholder="Number of Package">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="weight">Cargo Quantity (MT)</label>
                                                                                                    <input type="number" id="weight" value="{{ $cargo->weight }}" name="weight" required class="form-control" placeholder="Cargo Quantity (MT)">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="discharge_rate">Discharge Rate</label>
                                                                                                    <input type="number" id="discharge_rate" value="{{ $cargo->discharge_rate }}" name="discharge_rate" required class="form-control" placeholder="Discharge Rate">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="total_package">Total Number of Package in Words</label>
                                                                                                    <textarea name="total_package" class="form-control" id="total_package" placeholder="Total Number of Package in Words">{{ $cargo->total_package }}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipper">Shipper Details</label>
                                                                                                    <textarea name="shipper" class="form-control" id="shipper" required placeholder="Shipper Details">{{ $cargo->shipper }}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="notifying_address">Notifying Address</label>
                                                                                                    <textarea name="notifying_address" class="form-control" required id="notifying_address" placeholder="Notifying Address">{{ $cargo->notifying_address }}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="remarks">Remarks</label>
                                                                                                    <textarea name="remarks" class="form-control" id="remarks" placeholder="Remarks">{{ $cargo->remarks }}</textarea>
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
                                                                    </div>
                                                                </div>

                                                                <button onclick="deleteItem('{{ $cargo->id }}', '/delete-cargo')" class="btn btn-xs btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                @if($cargo->consignee->quotation_id == null || $cargo->consignee->quotation_id == 0)
                                                                <a href="{{ url('/proforma/'.$cargo->consignee->id) }}" class="btn btn-xs btn-warning">
                                                                        <i class="fa fa-money"></i>
                                                                </a>
                                                                @else
                                                                    <a href="{{ url('/proforma/'.$cargo->consignee->id) }}" class="btn btn-xs btn-success">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="tab-pane p-20" id="messages" role="tabpanel">
                                            <h3 class="text-center">Voyage Details</h3>
                                            @if($quotation->voyage == null)
                                                <form class="m-t-40" onsubmit="event.preventDefault();submitForm(this, '/voyage-details','redirect');" action="" id="voyage">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group" style="display: none">
                                                                <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">
                                                                <label for="name">Voyage Name</label>
                                                                <input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$quotation->vessel->name),$quotation->vessel->imo_number)->getName()}}" id="name" name="name" class="form-control" placeholder="Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="voyage_no">External Voyage Number</label>
                                                                <input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$quotation->vessel->name),$quotation->vessel->imo_number)->getName()}}"  id="voyage_no" name="voyage_no" class="form-control" placeholder="Voyage Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="internal_voyage_no">Internal Voyage No</label>
                                                                <input type="text"  id="internal_voyage_no" name="internal_voyage_no" value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$quotation->vessel->name),$quotation->vessel->imo_number)->getName()}}" class="form-control" placeholder="Internal Voyage No">
                                                            </div>
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="service_code">Service Code</label>--}}
                                                                <input type="hidden"  id="service_code" value="CODE" name="service_code" class="form-control" placeholder="Service Code">
                                                            {{--</div>--}}
                                                            <div class="form-group">
                                                                <label for="final_destination">Final Destination </label>
                                                                <input type="text" required id="final_destination" name="final_destination" class="form-control" placeholder="Final Destination">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="eta"> ETA (Date)</label>
                                                                <input type="text" required id="eta"  name="eta" class="form-control datepicker">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="eta_time"> ETA (Time)</label>
                                                                <input type="text" required id="eta_time"  name="eta_time" class="form-control timepicker1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vessel_arrived"> ATA (Date)</label>
                                                                <input type="text" required id="vessel_arrived"  name="vessel_arrived" class="form-control datepicker">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vessel_arrived_time"> ATA (Time)</label>
                                                                <input type="text" required id="vessel_arrived_time"  name="vessel_arrived_time" class="form-control timepicker1">
                                                            </div>
                                                            <div class="form-group">
                                                                <br>
                                                                <input class="btn pull-right btn-primary" type="submit" value="Save">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="row">
                                                    <table class="table table-stripped">
                                                        <tbody>
                                                        <tr>
                                                            <td><strong>Name : </strong>{{ ucwords($quotation->voyage->name )}}</td>
                                                            <td><strong>External Voyage NO : </strong> {{ strtoupper($quotation->voyage->voyage_no) }}</td>
                                                            <td><strong>Internal Voyage NO: </strong> {{ strtoupper($quotation->voyage->internal_voyage_no) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Final Destination : </strong>{{ ucwords($quotation->voyage->final_destination )}}</td>
                                                            <td><strong>ETA : </strong> {{ \Carbon\Carbon::parse($quotation->voyage->eta)->format('d-M-y H:i') }}</td>
                                                            <td><strong>Vessel Arrived : </strong> {{ \Carbon\Carbon::parse($quotation->voyage->vessel_arrived)->format('d-M-y H:i')}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
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
                                                <input type="number" required id="service_units" name="service_units" placeholder="Units" class="form-control service_units">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="number" required id="agency_sp" name="agency_sp" placeholder="Selling Price" class="form-control agency_sp">
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
                                            <th class="text-right">GRT/LOA</th>
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
                                    <button onclick="addServiceToQuotaion()" id="quotation-service" class="btn btn-primary pull-right">Add Service</button>
                                </div>
                            </div>
                            @endif
                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
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
                                                    <th class="text-right">GRT/LOA</th>
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
                                          <br>
                                    <b>Tax Registration</b>: 0121303W <br>
                                    <b>Telephone</b>: +254 41 2229784
                                </h4>  </table>
                                            <button onclick="addServiceToQuotaion()" class="btn btn-primary pull-right">Add Service</button>
                                        </div>
                                    </div>
                                @endif
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
                                @foreach($quotation->services as $service)
                                    <tr>
                                        <td>{{ ucwords($service->description) }}</td>
                                        <td class="text-left">{{ $service->grt_loa }}</td>
                                        <td class="text-right">{{ $service->agency_sp }}</td>
                                        <td class="text-right">{{ $service->units }}</td>
                                        <td class="text-right">{{ $service->tax_amount }}</td>
                                        <td class="text-right">{{ number_format($service->total,2) }}</td>
                                        <td class="text-right">
                                            @can('can-edit-quote')
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
@endcan
                                            @can('can-delete-quote')
                                            <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                                @endcan
                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form>
                        <div class="pull-right m-t-30 text-right">
                            <p id="sub_ex"><b>Total (Excl)</b> {{$quotation->lead->currency }} : {{ number_format(($quotation->services->sum('total',2) - $quotation->services->sum('tax')),2) }}</p>
                            <p id="total_tax"><b>Tax</b> {{$quotation->lead->currency }} : {{ number_format($quotation->services->sum('tax'),2) }} </p>
                            <p id="sub_in"><b>Total (Incl)</b> {{$quotation->lead->currency }} : <span class="sum-total">{{ number_format($quotation->services->sum('total'),2) }} </span></p>

                            <p id="rem_amount"><b>Remittance</b> <input type="text" value="{{ $quotation->remittance }}" name="remittance" id="add-rem"  class="form-control" style="width: 30% !important;">
                                <input type="hidden" name="quote_id" value="{{$quotation->id}}">
                                <button class="btn btn-success btn-submit">Submit</button>
                            </p>

                            <hr>
                            <h3 id="total_amount">Balance (Incl) {{$quotation->lead->currency }} : <span class="bal">{{ number_format(($quotation->services->sum('total') - $quotation->remittance),2) }}</span></h3>

                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_DECLINED)
                            @can('can-add-remittance')
                            <form class="form-inline" action="">
                                <div class="form-group">
                                    <label for="remittance">Remittance</label>
                                    <input type="number" name="remittance" id="remittance" placeholder="Remittance Amount in {{$quotation->lead->currency}}" class="form-control">
                                </div>
                                <button type="button" onclick="addRemittance()" class="btn btn-primary">Add Remittance</button>
                                <button type="button" onclick="reduceRemittance()" class="btn btn-danger">Reduce Remittance</button>
                            </form>
                            @endcan
                            @endif
                        </div>
                        </form>
                        <div class="clearfix"></div>
                        <hr>
                        <form action="" method="post" onsubmit="event.preventDefault();submitForm(this, '/notifying','redirect');" id="notifying">
                        <div class="row">
                            <div class="col-sm-12">
                                @if($quotation->parties != null)
                                    @foreach(json_decode($quotation->parties->emails) as $party)
                                        <b>{{$loop->iteration}}. </b> {{ $party }}
                                    @endforeach
                                @endif
                                    <br>
                                    <br>
                            </div>
                                <div class="col-sm-3">Add Emails to CC</div>
                                <div class="col-sm-6">
                                    <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                    <div class="form-group">
                                        <input type="text" name="notifying" placeholder="Add emails here separate with (,) " class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary pull-right">Add Emails</button>
                                </div>
                        </div>
                        </form>
                        <hr>
                        <div class="col-sm-12">
                            <h3>Remarks</h3>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Remarks</th>
                                    <th class="text-right">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotation->remarks->sortByDesc('created_at') as $remark)
                                    <tr>
                                        <td>{{ ucwords($remark->user->name) }}</td>
                                        <td>{{ ucfirst($remark->remark) }}</td>
                                        <td class="text-right">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <form id="pda_remarks_form" action="" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary pull-right"  onclick="event.preventDefault(); remark()">Add remark</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="text-right">
                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)
                                <a target="_blank" href="{{ url('/quotation/download/'.$quotation->id) }}" class="btn btn btn-outline-success">Download</a>
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
                                                                <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                                                <div class="form-group">
                                                                    <input type="text" value="{{strtoupper($quotation->vessel->name)}}" required id="subject" name="subject" class="form-control"
                                                                           placeholder="Subject">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" value="{{$quotation->lead->email}}" required id="email" name="email" class="form-control"
                                                                           placeholder="Client Email">
                                                                </div>
                                                                <div class="form-group">
                                                                                <textarea name="message" id="mymce" cols="30"
                                                                                          rows="10" placeholder="Message"
                                                                                          class="form-control"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input class="btn pull-right  btn btn-outline-success" type="submit" onclick="cssLoader()" value="Send To Customer">
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
                            @endif

                                @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING || $quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)
                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary" onclick="cssLoader()">Accepted</a>
                                <a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" class="btn btn-danger" onclick="cssLoader()"> Declined </a>
                                @endif
                                @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED || $quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_CHECKED)
                                <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary" onclick="cssLoader()">Start Processing</a>
                                @endif
{{--                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Archive</a>--}}
                                <a target="_blank" href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>
                                @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                    @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CHECKED)
                                        <a href="{{ url('/quotation/request/'.$quotation->id) }}" class="btn btn-success" onclick="cssLoader()"> Request Approval </a>
                                    @endif
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $(".btn-submit").click(function(e){

            e.preventDefault();
            var name = $("input[name=remittance]").val();
            var quote_id = $("input[name=quote_id]").val();

            $.ajax({
                type:'POST',
                url:'/update-rem',
                data:{remittance:name,quote_id:quote_id},
                success:function(data){
                    location.reload();
                }
            });
        });

        $(document).ready(function() {
            $('.service_units').on('keyup',function(){        
               if($(this).val() < 1){            
               $(this).val(1);            
               }
            })

            $('.service_units').on('click',function(){          
               if($(this).val() < 1){          
               $(this).val(1);          
               }
            })

             $('.agency_sp').on('keyup',function(){        
               if($(this).val() < 1){            
               $(this).val(1);            
               }
            })

            $('.agency_sp').on('click',function(){          
               if($(this).val() < 1){          
               $(this).val(1);          
               }
            })


             $('.discharge_rate').on('keyup',function(){        
               if($(this).val() < 1){            
               $(this).val(1);            
               }
            })

            $('.discharge_rate').on('click',function(){          
               if($(this).val() < 1){          
               $(this).val(1);          
               }
            })

            $('.weight').on('keyup',function(){        
               if($(this).val() < 1){            
               $(this).val(1);            
               }
            })

            $('.weight').on('click',function(){          
               if($(this).val() < 1){          
               $(this).val(1);          
               }
            })
        
        //discharge_rate
        //agency_sp
            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }
        });
        var containerType = $('#good_type_id');
        var thediv = $('#con');
        $('.timepicker1').timepicker({'showMeridian':false});
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
                thediv.empty();
//                return true;
//                contractValue.val('');
//                thediv.empty().append(
//                    '<div class="form-group">' +
//                    '<label for="type">Non Conventional Cargo Type</label>' +
//                    '<select name="type" id="type" required class="form-control">'+
//                    '<option>Select Cargo Type</option>'+
//                    '<option value="Animal">Animal</option>'+
//                    '<option value="Bulk">Bulk</option>'+
//                    '<option value="Bulk Liquid">Bulk Liquid</option>'+
//                    '<option value="General Cargo">General Cargo</option>'+
//                    '<option value="Motor Vehicle">Motor Vehicle</option>' +
//                        '</select></div>'
//            );

            }
        });
        function submitRem(data, formUrl) {
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


        var form = $('#pda_remarks_form');
        var currency = '{{$quotation->lead->currency }}';

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

            'grt' : '{{ $quotation->vessel->grt }}',
            'loa' : '{{ $quotation->vessel->loa }}',
            'currency' : '{{$quotation->lead->currency}}',
            '_token' : '{{ csrf_token() }}',
            'c_weight' : '{{ count($quotation->cargos) < 1 ? 0 : $quotation->cargos->sum('weight') }}',
            'quotation' : '{{ $quotation->id }}',
            'port_stay' : '{{$quotation->cargos->first() ? ( $quotation->cargos->first()->discharge_rate !=0 ? ceil(($quotation->cargos->sum('weight'))/$quotation->cargos->first()->discharge_rate): 1) : '1' }}',
            'service': {}
        };

        $('#currency').empty().append('CURRENCY ' + this.data.currency);

        function addConsigneeDetails(lead) {
            console.log(lead);
        }

        function addRemittance() {
            var remittanceAmount = $('#remittance').val();

            if(remittanceAmount !== '' && remittanceAmount !== null ){
                $(function () {
                    $(".preloader").fadeOut();
                });
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

                    var  grt_loa = selectedTariff.unit_value;
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
                        'total' : ((parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100))
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
                        'total' : ((parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100))
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
                        'total' : ((parseFloat(agency_sp)* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * parseFloat(agency_sp)* parseFloat(serviceUnit))) / 100)
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
                $(function () {
                    $(".preloader").fadeOut();
                });
                $('#quotation-service')
                    .html("Please Wait...")
                    .attr('disabled', 'disabled');

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
                if(parseFloat(this.data.port_stay) < 1 && JSON.parse($('#'+selected.id).val()).unit_type === 'per day'){
                    alert("Number of days is below one calculation not possible add Cargo Details to proceed");
                    resetForm();
                }
                else {
                    if(JSON.parse($('#'+selected.id).val()).unit_type === 'per day'){
                        $('#service_units').val(this.data.port_stay);
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
                        $('#service_units').attr('readonly','readonly');
                    }
                    else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Lumpsum'){
                        $('#service_units').val(1);
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
                        $('#service_units').attr('readonly','readonly');
                    }
                    else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Per Mt'){
                        $('#service_units').val(this.data.c_weight);
                        $('#service_units').attr('readonly','readonly');
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
                    }
                    else if(JSON.parse($('#'+selected.id).val()).unit_type === 'Thereafter Days'){
                        $('#service_units').val(this.data.port_stay);
                        $('#service_units').attr('readonly','readonly');
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
                    }
                    else if(JSON.parse($('#'+selected.id).val()).type === 'kpa'){
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
                    }
                    else {
                        $('#agency_sp').val(JSON.parse($('#'+selected.id).val()).rate);
                        $('#agency_sp').attr('readonly','readonly');
//                    $('#service_units').removeAttr('readonly').val('');
//                    $('#agency_sp').removeAttr('readonly').val('');
                    }
                }
            }
        }

    </script>
@endsection
