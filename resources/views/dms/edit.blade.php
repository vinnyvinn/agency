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
                <h3 class="text-center">{{ ucwords($dms->vessel->name) }} | {{ ucwords( $dms->customer->Name)  }} <br></h3>
                <br>
                <div class="row">
                    <div class="card-body wizard-content">
                        <div class="col-md-12">
                            @if($update)
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Update Profoma Disbursement Account</h4>
                                        <div class="col-12">
                                            <form style="text-align: left !important;" id="update_service{{$dms->id}}" action="{{ url('/update-dms') }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="description text-left">Client Name</label>
                                                            <input type="text" value="{{ ucwords($dms->customer->Name) }}" readonly disabled class="form-control">
                                                        </div>
                                                        {{--<div class="form-group">--}}
                                                            {{--<label for="code_name">Code Name</label>--}}
                                                            {{--<input type="text" required id="code_name" name="code_name" class="form-control">--}}
                                                        {{--</div>--}}
                                                        <div class="form-group">
                                                            <label for="seal_number">Seal Number</label>
                                                            <input type="text" required id="seal_number" name="seal_number" class="form-control">
                                                        </div>
                                                        {{--TODO berth number update--}}
                                                        <div class="form-group">
                                                            <label for="berth_number">Berth Number</label>
                                                            <input type="text" required id="berth_number" name="berth_number" class="form-control">
                                                        </div>
                                                       {{--  @if($dms->quote) --}}
                                                        @foreach($dms->quote->cargos as $cargo)
                                                            <div class="form-group">
                                                                <label for="cargo_bl">Update ({{$cargo->name}}) Cargo For {{ucwords($cargo->consignee->consignee_name)}} BL Number</label>
                                                                <input type="text" required id="cargo_bl" name="cargo_bl[{{$cargo->id}}]" class="form-control">
                                                            </div>
                                                        @endforeach
                                                       {{--  @endif --}}
                                                        <div class="form-group">
                                                            <label for="eta">Update ETA Date</label>
                                                            <input type="text" required id="eta" name="eta" class="datepicker form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="eta_time">Update ETA Time</label>
                                                            <input type="text" required id="eta_time" name="eta_time" class="timepicker1 form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="laytime_start">Lay Time Start(Date)</label>
                                                            <input type="text" required id="laytime_start" name="laytime_start" class="datepicker form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="laytime_time">Lay Time Start(Time)</label>
                                                            <input type="text" required id="laytime_time" name="laytime_time" class="timepicker1 form-control">
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="place_of_receipt">Place of Receipt</label>
                                                            <input type="text" required id="place_of_receipt" name="place_of_receipt" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ata">Update ATA Date</label>
                                                            <input type="text" required id="ata" name="ata" class="datepicker form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ata_time">Update ATA Time</label>
                                                            <input type="text" required id="ata_time" name="ata_time" class="timepicker1 form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date_of_loading">NOR Date</label>
                                                            <input type="text" required id="date_of_loading" name="date_of_loading" class="datepicker form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date_of_loading_time">NOR Time</label>
                                                            <input type="text" required id="date_of_loading_time" name="date_of_loading_time" class="timepicker1 form-control">
                                                        </div>
                                                        <input type="hidden" name="dms_id" value="{{ $dms->id }}">
                                                        <div class="form-group">
                                                            <label for="time_allowed">Time Allowed</label>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group"><label for="days">Number of Days</label>
                                                                                <input required  type="number" name="days" id="days" class="form-control days">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group"><label for="days">Number of Hours</label>
                                                                                <input required  type="number" name="hour" id="hour" class="form-control hours">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group"><label for="hours">Number of Mins</label>
                                                                                <input required  type="number" name="min" id="min" class="form-control mins">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="form-group"><label for="hours">Number of Secs</label>
                                                                                <input required  type="number" name="sec" id="sec" class="form-control secs">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="number_of_crane">Total Number of Cranes </label>
                                                            <input type="number" required id="number_of_crane" name="number_of_crane" class="form-control cranes" placeholder="Total Number of Cranes">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">**Note you can still make Changes later</label>
                                                            <input class="btn pull-right btn-primary" type="submit" value="Update">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Final Disbursement Account Details</h4>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pda" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Files</span>
                                            </a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Cargo</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Details</span></a> </li>
                                         <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#agency" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Actions</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sof" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SOF</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#xxxx" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Checklist Details</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hixstory" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">History</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cost" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Budget</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#state" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Statement</span></a> </li>


                                        {{--@foreach(\App\Stage::all() as $value)--}}
                                            {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#{{ str_slug($value->name) }}" role="tab">--}}
                                                    {{--<span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">{{ ucwords($value->name) }}</span></a> </li>--}}
                                            {{--@endforeach--}}

                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="pda" role="tabpanel">

                                            <div class="p-20">
                                                <div class="col-sm-12">
                                                    <h4>Client Files</h4>
                                                    <div class="col-sm-12">
                                                        @if($dms->vessel)
                                                        @foreach($dms->vessel->vDocs as $doc)
                                                            {{ $loop->iteration }} . <a href="{{ url($doc->doc_path) }}" target="_blank" >{{ $doc->name }}</a>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-sm-6">
                                                        <button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-info">
                                                        Upload Client Doc
                                                    </button>
                                                </div>
                                                @if($dms->berth_number == "")
                                                    <div class="col-sm-6">
                                                        <form action="{{url('/update-berth')}}" method="post">
                                                            <div class="form-group">
                                                                {{ csrf_field() }}
                                                                <label for="">Update Berth Number</label>
                                                                <input type="hidden" value="{{$dms->id}}" name="id">
                                                                <input type="text" name="berth_number" placeholder="Update Berth Number" class="form-control">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/vessel/doc/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="vessel_id" value="{{ $dms->vessel->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="name">Document Name</label>
                                                                                    <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="doc">Select Doc</label>
                                                                                    <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn btn-block btn-primary" type="submit" value="Upload">
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
                                        <div class="tab-pane" id="home" role="tabpanel">
                                            <div class="p-20">
                                                <table class="table table-boarded">
                                                    <tr>
                                                        <td><strong>Name : </strong> {{ $dms->vessel->name }}</td>
                                                        @if($dms->quote)

                                                        <td><strong>BL NO : </strong>

                                                            @foreach($dms->quote->cargos as $cargo)
                                                            {{ $cargo->bl_no }},
                                                                @endforeach
                                                        </td>
                                                            @endif
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Time Allowed : </strong> {{ (new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed))))->format('%a Days, %h Hours, %i Minutes, %s Seconds')}} </td>
                                                        <td><strong>Seal NO : </strong> {{ $dms->seal_number }}</td>
                                                        <td><strong>Berth NO : </strong> {{ $dms->berth_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Country : </strong> {{ $dms->vessel->country }}</td>
                                                        <td><strong>Call Sign : </strong> {{ $dms->vessel->call_sign }}</td>
                                                        <td><strong>IMO Number : </strong> {{ $dms->vessel->imo_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Cargo Discharge Rate : </strong> {{ $dms->quote ? $dms->quote->cargos->first()->discharge_rate : 'Not Set' }} MT / WWD</td>
                                                        <td><strong>Lay Time Start : </strong> {{ \Carbon\Carbon::parse($dms->laytime_start)->format('d-M-y H:i') }}</td>
                                                        <td><strong>DWT : </strong> {{ $dms->vessel->dwt }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>LOA : </strong> {{ $dms->vessel->loa }}</td>
                                                        <td><strong>GRT : </strong> {{ $dms->vessel->grt }}</td>
                                                        <td><strong>Consignee Cargo : </strong> {{ $dms->quote ? $dms->quote->cargos->first()->weight : 0}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>NRT : </strong> {{ $dms->vessel->nrt }}</td>
                                                        <td><strong>Chargeable GRT : </strong> {{ $dms->vessel->grt }}</td>
                                                        <td><strong>Port of Loading: </strong> {{ $dms->vessel->port_of_loading }}, {{ $dms->vessel->country_of_loading }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Port of Discharge: </strong> {{ $dms->vessel->port_of_discharge }}, {{ $dms->vessel->country_of_discharge }}</td>
                                                        <td><strong>Place of Receipt: </strong> {{ $dms->place_of_receipt }}</td>
                                                        <td><strong>Date of Loading : </strong> {{ \Carbon\Carbon::parse($dms->date_of_loading)->format('d-M-y') }}</td>
                                                    </tr>
                                                </table>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-dms">Update Details</button>
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/vessel/doc/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="vessel_id" value="{{ $dms->vessel->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="name">Document Name</label>
                                                                                    <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="doc">Select Doc</label>
                                                                                    <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn btn-block btn-primary" type="submit" value="Upload">
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
                                            @if($dms->quote)
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Cargo Type</th>
                                                    <th>Discharge Rate</th>
                                                    <th>Port Stay</th>
                                                    <th>Shipping Type</th>
                                                    <th>Package</th>
                                                    <th>Weight</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($dms->quote->cargos as $cargo)
                                                    <tr>
                                                        <td>{{ ucwords($cargo->name) }}</td>
                                                        <td>{{ ucfirst($cargo->goodType->name )}}</td>
                                                        <td>{{ $cargo->discharge_rate }}</td>
                                                        <td>{{ ceil($cargo->weight/$cargo->discharge_rate) }} Days</td>
                                                        <td>{{ ucwords($cargo->shipping_type) }}</td>
                                                        <td>{{ $cargo->package }}</td>
                                                        <td>{{ $cargo->weight }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                                @endif
                                        </div>
                                        <div class="tab-pane p-20" id="messages" role="tabpanel">
                                              @if($dms->quote->voyage == null)
                                                <form class="m-t-40" onsubmit="event.preventDefault();submitForm(this, '/voyage-details','redirect');" action="" id="voyage">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group" style="display: none">
                                                                <input type="hidden" name="quotation_id" value="{{ $dms->quote->id }}">
                                                                <label for="name">Voyage Name</label>
                                                                <input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$dms->quote->vessel->name),$dms->quote->vessel->imo_number)->getName()}}" id="name" name="name" class="form-control" placeholder="Name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="voyage_no">External Voyage Number</label>
                                                                <input type="text" required value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$dms->quote->vessel->name),$dms->quote->vessel->imo_number)->getName()}}"  id="voyage_no" name="voyage_no" class="form-control" placeholder="Voyage Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="internal_voyage_no">Internal Voyage No</label>
                                                                <input type="text"  id="internal_voyage_no" name="internal_voyage_no" value="{{\Esl\Repository\ProjectRepo::init()->generateName(str_replace('MV',"",$dms->quote->vessel->name),$dms->quote->vessel->imo_number)->getName()}}" class="form-control" placeholder="Internal Voyage No">
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
                                                            <td><strong>Name : </strong>{{ $dms->quote->voyage ? ucwords($dms->quote->voyage->name) :''}}</td>
                                                            <td><strong>External Voyage NO : </strong> {{ $dms->quote->voyage ? strtoupper($dms->quote->voyage->voyage_no) :''}}</td>
                                                            <td><strong>Internal Voyage Code : </strong> {{ $dms->quote->voyage ? strtoupper($dms->quote->voyage->internal_voyage_no) :'' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Final Destination : </strong>{{ $dms->quote->voyage ? ucwords($dms->quote->voyage->final_destination ) : ''}}</td>
                                                            <td><strong>ETA : </strong> {{$dms->quote->voyage ?  \Carbon\Carbon::parse($dms->quote->voyage->eta)->format('d-M-y') : ''}}</td>
                                                            <td><strong>Vessel Arrived : </strong> {{ $dms->quote->voyage ? \Carbon\Carbon::parse($dms->quote->voyage->vessel_arrived)->format('d-M-y') : ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Service Code : </strong> {{ $dms->quote->voyage ? strtoupper($dms->quote->voyage->service_code) : ''}}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif
                                        </div>
                                        <div class="tab-pane p-20" id="agency" role="tabpanel">
                                            <h3 class="text-center">Generate Files</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-cfsrelease">CFS Release Order</button>
                                                    <div class="modal fade bs-example-modal-cfsrelease" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Generate CFS Release </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form id="cfsrelease" action="{{ url('/generate-documents/cfs-ro') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="bl_id" id="bl_id" value="{{$dms->id}}">
                                                                                <input type="hidden" name="vessel_name" id="vessel_name" value="{{$dms->vessel->name}}">
                                                                                <input type="hidden" name="voyage" id="voyage" value="{{$dms->quote->voyage ? $dms->quote->voyage->name : ''}}">
                                                                                <input type="hidden" name="port_of_loading" id="port_of_loading" value="{{$dms->vessel->port_of_loading}}">
                                                                                <input type="hidden" name="country" id="country" value="{{$dms->vessel->country_of_loading}}">
                                                                                <input type="hidden" name="eta" id="eta" value="{{$dms->quote->voyage ? $dms->quote->voyage->eta : ''}}">
                                                                                <label for="client">Delivery To</label>
                                                                                <input type="text" name="client" class="form-control" value="" required>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="form-group">
                                                                                <label for="manifest">Manifest Number</label>
                                                                                <input type="text" name="manifest" class="form-control" value="" required>
                                                                            </div>
                                                                            @if($dms->quote)
                                                                            @foreach($dms->quote->cargos as $cargo)
                                                                                <div class="row" id="row{{$cargo->id}}">
                                                                                    <div class="col-sm-12">
                                                                                        <h4>Cargo for {{ucwords($cargo->consignee->consignee_name)}}</h4>
                                                                                        <div class="form-group">
                                                                                            <input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">
                                                                                            <label for="bl_no">BL NO </label>
                                                                                            <input type="text" name="bl_no[{{$cargo->id}}]" class="form-control" value="{{$cargo->bl_no}}" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="marks">MARKS/NUMBERS</label>
                                                                                            <input type="text" name="marks[{{$cargo->id}}]" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="description">Description</label>
                                                                                            <textarea cols="30"
                                                                                                      rows="3" required name="description[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                        </div>
                                                                                        <input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">
                                                                                    </div>
                                                                                    <div class="col-sm-12">
                                                                                        <button onclick="deleteRow('row{{$cargo->id}}')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                            @endif
                                                                            <div class="col-sm-12">
                                                                                <br>
                                                                                <div class="form-group">
                                                                                    <button type="button" onclick="resetCfs()" class="btn btn-danger">Reset</button>
                                                                                    <button type="submit" class="btn btn-primary pull-right">Generate CFS</button>
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
                                                </div>
                                                @if($dms->vessel->loading_type == false)
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-inwardmani">INWARD CARGO MANIFEST</button>
                                                    <div class="modal fade bs-example-modal-inwardmani" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Generate Inward Manifest </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form id="inmanifest" action="{{ url('/generate-documents/manifest-in') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                                <input type="hidden" name="bl_id" id="bl_id" value="{{$dms->id}}">
                                                                                <input type="hidden" name="vessel_name" id="vessel_name" value="{{$dms->vessel->name}}">
                                                                                <input type="hidden" name="voyage" id="voyage" value="{{$dms->quote->voyage ? $dms->quote->voyage->name :''}}">
                                                                                <input type="hidden" name="voyage_nationality" id="voyage_nationality" value="{{$dms->quote->voyage ? $dms->quote->voyage->country :''}}">
                                                                                <input type="hidden" name="port_of_loading" id="port_of_loading" value="{{$dms->vessel->port_of_loading}}">
                                                                                <input type="hidden" name="port_of_discharge" id="port_of_discharge" value="{{$dms->vessel->port_of_discharge}}">
                                                                                <input type="hidden" name="country" id="country" value="{{$dms->vessel->country_of_loading}}">
                                                                                <input type="hidden" name="country_discharge" id="country_discharge" value="{{$dms->vessel->country_of_discharge}}">
                                                                                <input type="hidden" name="eta" id="eta" value="{{$dms->quote->voyage ? $dms->quote->voyage->eta :''}}">

                                                                            @if($dms->id == null)
                                                                                    @if(array_key_exists('incargoid',json_decode($dms->inWard->data, true)))
                                                                                        @foreach(json_decode($dms->inWard->data, true)['inweight'] as $key => $value)
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <h4>Cargo </h4>
                                                                                                    <div class="form-group">
                                                                                                        {{--<input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">--}}
                                                                                                        <label for="bl_no">BL NO </label>
                                                                                                        <input type="text" name="inbl_no[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inbl_no'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" name="incargoid" id="weight" value="{{json_decode($dms->inWard->data, true)['incargoid']}}">
                                                                                                        <label for="weight">Weight </label>
                                                                                                        <input type="text" name="inweight[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inweight'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="marks">MARKS/NUMBERS</label>
                                                                                                        <input type="text" name="inmarks[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inmarks'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" id="consignee_id" name="consignee_id" value="{{json_decode($dms->inWard->data, true)['consignee_id']}}">
                                                                                                        <label for="consignee">Consignee</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inconsignee[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inconsignee'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="shipper">Shipper</label>
                                                                                                        <textarea  cols="30"
                                                                                                                   rows="3" required name="inshipper[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inshipper'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="party">Notify Party</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inparty[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inparty'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="description">Description</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="indescription[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['indescription'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    {{--<input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">--}}
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @if(array_key_exists('weight',json_decode($dms->inWard->data, true)))
                                                                                        @foreach(json_decode($dms->inWard->data, true)['weight'] as $key => $cargo)
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <h4>Cargo </h4>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{json_decode($dms->inWard->data, true)['weight'][$key]}}">
                                                                                                    <label for="bl_no">BL NO </label>
                                                                                                    <input type="text" name="bl_no[{{$cargo->id}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['bl_no'][$key]}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="marks">MARKS/NUMBERS</label>
                                                                                                    <input type="text" name="marks[{{$cargo->id}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['marks'][$key]}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" id="consignee_id" name="consignee_id" value="{{json_decode($dms->inWard->data, true)['consignee_id']}}">
                                                                                                    <label for="consignee">Consignee</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="consignee[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['consignee'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipper">Shipper</label>
                                                                                                    <textarea  cols="30"
                                                                                                               rows="3" required name="shipper[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['shipper'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="party">Notify Party</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="party[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['party'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="description">Description</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="description[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['description'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <input type="hidden" id="bl_id" name="bl_id" value="{{json_decode($dms->inWard->data, true)['bl_id']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                            @else

                                                                                @if($dms->quote)
                                                                                @foreach($dms->quote->cargos as $cargo)
                                                                                    @if(count(explode(",",$cargo->bl_no)) > 1)
                                                                                        @foreach(explode(",",$cargo->bl_no) as $key => $value)
                                                                                            <div class="row" id="inman{{$cargo->id}}">
                                                                                                <div class="col-sm-12">
                                                                                                    <h4>Cargo for {{ucwords($cargo->consignee->consignee_name)}}</h4>
                                                                                                    <div class="form-group">
                                                                                                        {{--<input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">--}}
                                                                                                        <label for="bl_no">BL NO </label>
                                                                                                        <input type="text" name="inbl_no[{{$key}}]" class="form-control" value="{{explode(",",$cargo->bl_no)[$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" name="incargoid" id="weight" value="{{$cargo->id}}">
                                                                                                        <label for="weight">Weight </label>
                                                                                                        <input type="text" name="inweight[{{$key}}]" class="form-control" value="{{$cargo->weight/count(explode(",",$cargo->bl_no))}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="marks">MARKS/NUMBERS</label>
                                                                                                        <input type="text" name="inmarks[{{$key}}]" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" id="consignee_id" name="consignee_id" value="{{$cargo->consignee->id}}">
                                                                                                        <label for="consignee">Consignee</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inconsignee[{{$key}}]" class="form-control">{{strtoupper($cargo->consignee->consignee_name."\n".$cargo->consignee->consignee_address)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="shipper">Shipper</label>
                                                                                                        <textarea  cols="30"
                                                                                                                   rows="3" required name="inshipper[{{$key}}]" class="form-control">{{strtoupper($cargo->shipper)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="party">Notify Party</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inparty[{{$key}}]" class="form-control">{{strtoupper($cargo->notifying_address)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="description">Description</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="indescription[{{$key}}]" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                                    </div>
                                                                                                    {{--<input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">--}}
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <button onclick="deleteRow('inman{{$key}}')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="row" id="inman{{$cargo->id}}">
                                                                                            <div class="col-sm-12">
                                                                                                <h4>Cargo for {{ucwords($cargo->consignee->consignee_name)}}</h4>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">
                                                                                                    <label for="bl_no">BL NO </label>
                                                                                                    <input type="text" name="bl_no[{{$cargo->id}}]" class="form-control" value="{{$cargo->bl_no}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="marks">MARKS/NUMBERS</label>
                                                                                                    <input type="text" name="marks[{{$cargo->id}}]" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" id="consignee_id" name="consignee_id" value="{{$cargo->consignee->id}}">
                                                                                                    <label for="consignee">Consignee</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="consignee[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->consignee->consignee_name."\n".$cargo->consignee->consignee_address)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipper">Shipper</label>
                                                                                                    <textarea  cols="30"
                                                                                                               rows="3" required name="shipper[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->shipper)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="party">Notify Party</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="party[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->notifying_address)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="description">Description</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="description[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                                </div>
                                                                                                <input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">
                                                                                            </div>
                                                                                            <div class="col-sm-12">
                                                                                                <button onclick="deleteRow('inman{{$cargo->id}}')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                            @endif

                                                                            <div class="col-sm-12">
                                                                                <br>
                                                                                <div class="form-group">
                                                                                    <button type="button" onclick="resetCfs()" class="btn btn-danger">Reset</button>
                                                                                    <button type="submit" class="btn btn-primary pull-right">Generate Inward Manifest</button>
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
                                                </div>
                                                @else

                                                <div class="col-sm-3">
                                                    <button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-outwardmani">INWARD CARGO MANIFEST</button>
                                                    <div class="modal fade bs-example-modal-outwardmani" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Generate Outward Manifest </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form id="inmanifest" action="{{ url('/generate-documents/manifest-in') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                                <input type="hidden" name="bl_id" id="bl_id" value="{{$dms->id}}">
                                                                                <input type="hidden" name="outward" id="outward" value="{{$dms->id}}">
                                                                                <input type="hidden" name="vessel_name" id="vessel_name" value="{{$dms->vessel->name}}">
                                                                                <input type="hidden" name="voyage" id="voyage" value="{{$dms->quote->voyage ? $dms->quote->voyage->name :''}}">
                                                                                <input type="hidden" name="voyage_nationality" id="voyage_nationality" value="{{$dms->quote->voyage ? $dms->quote->voyage->country : ''}}">
                                                                                <input type="hidden" name="port_of_loading" id="port_of_loading" value="{{$dms->vessel->port_of_loading}}">
                                                                                <input type="hidden" name="port_of_discharge" id="port_of_discharge" value="{{$dms->vessel->port_of_discharge}}">
                                                                                <input type="hidden" name="country" id="country" value="{{$dms->vessel->country_of_loading}}">
                                                                                <input type="hidden" name="country_discharge" id="country_discharge" value="{{$dms->vessel->country_of_discharge}}">
                                                                                <input type="hidden" name="eta" id="eta" value="{{$dms->quote->voyage ? $dms->quote->voyage->eta :''}}">

                                                                            @if($dms->id == null)
                                                                                    @if(array_key_exists('incargoid',json_decode($dms->inWard->data, true)))
                                                                                        @foreach(json_decode($dms->inWard->data, true)['inweight'] as $key => $value)
                                                                                            <div class="row">
                                                                                                <div class="col-sm-12">
                                                                                                    <h4>Cargo </h4>
                                                                                                    <div class="form-group">
                                                                                                        {{--<input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">--}}
                                                                                                        <label for="bl_no">BL NO </label>
                                                                                                        <input type="text" name="inbl_no[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inbl_no'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" name="incargoid" id="weight" value="{{json_decode($dms->inWard->data, true)['incargoid']}}">
                                                                                                        <label for="weight">Weight </label>
                                                                                                        <input type="text" name="inweight[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inweight'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="marks">MARKS/NUMBERS</label>
                                                                                                        <input type="text" name="inmarks[{{$key}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['inmarks'][$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" id="consignee_id" name="consignee_id" value="{{json_decode($dms->inWard->data, true)['consignee_id']}}">
                                                                                                        <label for="consignee">Consignee</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inconsignee[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inconsignee'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="shipper">Shipper</label>
                                                                                                        <textarea  cols="30"
                                                                                                                   rows="3" required name="inshipper[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inshipper'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="party">Notify Party</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inparty[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['inparty'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="description">Description</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="indescription[{{$key}}]" class="form-control">{{json_decode($dms->inWard->data, true)['indescription'][$key]}}</textarea>
                                                                                                    </div>
                                                                                                    {{--<input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">--}}
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @if(array_key_exists('weight',json_decode($dms->inWard->data, true)))
                                                                                        @foreach(json_decode($dms->inWard->data, true)['weight'] as $key => $cargo)
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <h4>Cargo </h4>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{json_decode($dms->inWard->data, true)['weight'][$key]}}">
                                                                                                    <label for="bl_no">BL NO </label>
                                                                                                    <input type="text" name="bl_no[{{$cargo->id}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['bl_no'][$key]}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="marks">MARKS/NUMBERS</label>
                                                                                                    <input type="text" name="marks[{{$cargo->id}}]" class="form-control" value="{{json_decode($dms->inWard->data, true)['marks'][$key]}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" id="consignee_id" name="consignee_id" value="{{json_decode($dms->inWard->data, true)['consignee_id']}}">
                                                                                                    <label for="consignee">Consignee</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="consignee[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['consignee'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipper">Shipper</label>
                                                                                                    <textarea  cols="30"
                                                                                                               rows="3" required name="shipper[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['shipper'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="party">Notify Party</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="party[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['party'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="description">Description</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="description[{{$cargo->id}}]" class="form-control">{{json_decode($dms->inWard->data, true)['description'][$key]}}</textarea>
                                                                                                </div>
                                                                                                <input type="hidden" id="bl_id" name="bl_id" value="{{json_decode($dms->inWard->data, true)['bl_id']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                            @else
                                                                                @if($dms->quote)
                                                                                @foreach($dms->quote->cargos as $cargo)
                                                                                    @if(count(explode(",",$cargo->bl_no)) > 1)
                                                                                        @foreach(explode(",",$cargo->bl_no) as $key => $value)
                                                                                            <div class="row" id="inman{{$cargo->id}}">
                                                                                                <div class="col-sm-12">
                                                                                                    <h4>Cargo for {{ucwords($cargo->consignee->consignee_name)}}</h4>
                                                                                                    <div class="form-group">
                                                                                                        {{--<input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">--}}
                                                                                                        <label for="bl_no">BL NO </label>
                                                                                                        <input type="text" name="inbl_no[{{$key}}]" class="form-control" value="{{explode(",",$cargo->bl_no)[$key]}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" name="incargoid" id="weight" value="{{$cargo->id}}">
                                                                                                        <label for="weight">Weight </label>
                                                                                                        <input type="text" name="inweight[{{$key}}]" class="form-control" value="{{$cargo->weight/count(explode(",",$cargo->bl_no))}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="marks">MARKS/NUMBERS</label>
                                                                                                        <input type="text" name="inmarks[{{$key}}]" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <input type="hidden" id="consignee_id" name="consignee_id" value="{{$cargo->consignee->id}}">
                                                                                                        <label for="consignee">Consignee</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inconsignee[{{$key}}]" class="form-control">{{strtoupper($cargo->consignee->consignee_name."\n".$cargo->consignee->consignee_address)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="shipper">Shipper</label>
                                                                                                        <textarea  cols="30"
                                                                                                                   rows="3" required name="inshipper[{{$key}}]" class="form-control">{{strtoupper($cargo->shipper)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="party">Notify Party</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="inparty[{{$key}}]" class="form-control">{{strtoupper($cargo->notifying_address)}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label for="description">Description</label>
                                                                                                        <textarea cols="30"
                                                                                                                  rows="3" required name="indescription[{{$key}}]" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                                    </div>
                                                                                                    {{--<input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">--}}
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <button onclick="deleteRow('inman{{$key}}')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="row" id="inman{{$cargo->id}}">
                                                                                            <div class="col-sm-12">
                                                                                                <h4>Cargo for {{ucwords($cargo->consignee->consignee_name)}}</h4>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" name="weight[{{$cargo->id}}]" id="weight" value="{{$cargo->weight}}">
                                                                                                    <label for="bl_no">BL NO </label>
                                                                                                    <input type="text" name="bl_no[{{$cargo->id}}]" class="form-control" value="{{$cargo->bl_no}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="marks">MARKS/NUMBERS</label>
                                                                                                    <input type="text" name="marks[{{$cargo->id}}]" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" id="consignee_id" name="consignee_id" value="{{$cargo->consignee->id}}">
                                                                                                    <label for="consignee">Consignee</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="consignee[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->consignee->consignee_name."\n".$cargo->consignee->consignee_address)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="shipper">Shipper</label>
                                                                                                    <textarea  cols="30"
                                                                                                               rows="3" required name="shipper[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->shipper)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="party">Notify Party</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="party[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->notifying_address)}}</textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="description">Description</label>
                                                                                                    <textarea cols="30"
                                                                                                              rows="3" required name="description[{{$cargo->id}}]" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                                </div>
                                                                                                <input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">
                                                                                            </div>
                                                                                            <div class="col-sm-12">
                                                                                                <button onclick="deleteRow('inman{{$cargo->id}}')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                            @endif

                                                                            <div class="col-sm-12">
                                                                                <br>
                                                                                <div class="form-group">
                                                                                    <button type="button" onclick="resetCfs()" class="btn btn-danger">Reset</button>
                                                                                    <button type="submit" class="btn btn-primary pull-right">Generate Outward Manifest</button>
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
                                                </div>

                                                @endif
                                            </div>
                                            @if($dms->quote)
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Cargo </th>
                                                    <th>Consignee</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dms->quote->cargos as $cargo)
                                                    <tr>

                                                        <td>{{ ucwords($cargo->name) }}</td>
                                                        <td>{{ ucfirst($cargo->consignee->consignee_name )}}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-lock btn-success" data-toggle="modal" data-target=".bs-example-modal-do{{$cargo->id}}">DO</button>
                                                            <div class="modal fade bs-example-modal-do{{$cargo->id}}" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myLargeModalLabel">DO Details </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <form id="do1{{$cargo->id}}" action="{{ url('/consignee/do') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group">
                                                                                                <label for="client">Clearing Agent</label>
                                                                                                <input type="text" name="client" class="form-control" value="" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <input type="hidden" id="consignee_id" name="consignee_id" value="{{$cargo->consignee->id}}">
                                                                                                <label for="consignee">Consignee</label>
                                                                                                <textarea cols="30"
                                                                                                          rows="3" required name="consignee" class="form-control">{{strtoupper($cargo->consignee->consignee_name."\n".$cargo->consignee->consignee_address)}}</textarea>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="shipper">Shipper</label>
                                                                                                <textarea  cols="30"
                                                                                                          rows="3" required name="shipper" class="form-control">{{strtoupper($cargo->shipper)}}</textarea>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="party">Notify Party</label>
                                                                                                <textarea cols="30"
                                                                                                          rows="3" required name="party" class="form-control">{{strtoupper($cargo->notifying_address)}}</textarea>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="marks">MARKS/NUMBERS</label>
                                                                                                <input type="text" name="marks" class="form-control" value="{{$cargo->good_type_id == 1 ? $cargo->container_id : 'N/A'}}" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="description">Description</label>
                                                                                                <textarea cols="30"
                                                                                                          rows="3" required name="description" class="form-control">{{strtoupper($cargo->description)}}</textarea>
                                                                                            </div>
                                                                                            <input type="hidden" id="bl_id" name="bl_id" value="{{$dms->id}}">
                                                                                            <div class="form-group">
                                                                                                <button type="submit" class="btn btn-primary pull-right">Delivery Order</button>
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
                                                            <button class="btn btn-sm btn-lock btn-success" data-toggle="modal" data-target=".bs-example-modal-edo{{$cargo->id}}">EDO</button>
                                                            <div class="modal fade bs-example-modal-edo{{$cargo->id}}" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myLargeModalLabel">Generate EDO </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-12">
                                                                                <form id="edo{{$cargo->id}}" action="{{ url('/consignee/edo') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group">
                                                                                                <input type="hidden" name="cargo_id" value="{{$cargo->id}}">
                                                                                                <label for="pin">Clearing Agent PIN</label>
                                                                                                <input type="text" name="pin" class="form-control" value="" required>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="edo">Select Action</label>
                                                                                                <select name="edo" id="edo" required
                                                                                                        class="form-control">
                                                                                                    <option value="">Select Action</option>
                                                                                                    <option value="9">Select Original File</option>
                                                                                                    <option value="1">Select Delete File</option>
                                                                                                    <option value="5">Select Replace File</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <button type="submit" class="btn btn-primary pull-right">EDO</button>
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
                                                            {{--<button class="btn btn-sm btn-lock btn-success">CFS</button>--}}
                                                            <button class="btn btn-sm btn-lock btn-success" style="display: none">I/MANIFEST</button>
                                                            <button class="btn btn-sm btn-lock btn-success" style="display: none;">O/MANIFEST</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @endif

                                            <br>
                                              <br>
                                            <div class="row">

                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="sof" role="tabpanel">
                                            <h3 class="text-center">Statement Of Facts</h3>
                                            <div class="card">
                                                <div class="card-header">
                                                        <div class="pull-right">
                                                            <a href="{{ url('/generate/sof/'.$dms->id) }}" class="btn btn-info">Generate Sof</a>
                                                            <a href="{{ url('/generate/laytime/'.$dms->id) }}" class="btn btn-success">Generate Laytime</a>
                                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></button>
                                                        </div>

                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-boarded">
                                                        <thead>
                                                        <tr>
                                                            <th>Date Added</th>
                                                            <th>From Date/Time</th>
                                                            <th>To Date/Time</th>
                                                            <th>Crane</th>
                                                            <th>Remarks</th>
                                                            <th class="text-right">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="sof_list">
                                                        @foreach($dms->sof->sortBy('from') as $sof)
                                                            <tr>
                                                                <td>{{\Carbon\Carbon::parse($sof->created_at)->format('d-M-y')}}</td>
                                                                <td> {{\Carbon\Carbon::parse($sof->from)->format('d.m.Y H:i') }} HRS</td>
                                                                <td> {{\Carbon\Carbon::parse($sof->to)->format('d.m.Y H:i') }} HRS</td>
                                                                <td> {{ $sof->crane_working}}</td>
                                                                <td> {{ucfirst($sof->remarks)}}</td>
                                                                <td class="text-right">
                                                                        <button class="btn btn-sm btn-info"  data-toggle="modal" data-target=".bs-example-modal-ed{{$sof->id}}"><i class="fa fa-pencil"></i></button>
                                                                    <div class="modal fade bs-example-modal-ed{{$sof->id}}" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myLargeModalLabel">Add SOF </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="col-12">
                                                                                        <form id="checklist{{$sof->id}}" action="{{ url('dms/add/sof') }}" onsubmit="event.preventDefault(); addSof(this, '{{ url('dms/add/sof') }}')" method="post">
                                                                                            {{ csrf_field() }}
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <input type="hidden" name="bill_of_landing_id" value="{{ $dms->id }}">
                                                                                                    <input type="hidden" name="sof_id" value="{{ $sof->id }}">
                                                                                                    <div class="form-group">
                                                                                                        <label for="from">From (Date)</label>
                                                                                                        <input type="text" value="{{\Carbon\Carbon::parse($sof->from)->format('m/d/Y')}}" required id="from" name="from" class="datepicker form-control" placeholder="From">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <label for="to">To (Date)</label>
                                                                                                        <input type="text" value="{{\Carbon\Carbon::parse($sof->to)->format('m/d/Y')}}" required id="to" name="to" class="datepicker form-control" placeholder="To">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <label for="total_cranes">Total Cranes</label>
                                                                                                        <input type="number" value="{{$sof->total_cranes}}" required id="total_cranes" name="total_cranes" class="form-control" placeholder="Total Cranes">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <label for="">From (Time)</label>
                                                                                                        <input type="text" value="{{\Carbon\Carbon::parse($sof->from)->format('H:i')}}" required id="from_time" name="from_time" class="timepicker1 form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <label for="">To (Time)</label>
                                                                                                        <input type="text" value="{{\Carbon\Carbon::parse($sof->to)->format('H:i')}}" required id="to_time" name="to_time" class="timepicker1 form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div class="form-group">
                                                                                                        <label for="crane_working">Cranes Working</label>
                                                                                                        <input type="number" value="{{$sof->crane_working}}" required id="crane_working" name="crane_working" class="form-control" placeholder="Crane Working">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="consignee_id">Action</label>
                                                                                                        <select name="action" id="action" required class="form-control">
                                                                                                            <option value="">Select Action</option>
                                                                                                            <option value="calculate">Used for calculation</option>
                                                                                                            <option value="not_used">Normal Entry</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="remarks">Remarks</label>
                                                                                                        <textarea name="remarks" id="remarks" required cols="5" rows="3"
                                                                                                                  class="form-control">{{$sof->remarks}}</textarea>
                                                                                                    </div>
                                                                                                    <div class="form-group">
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
                                                                        {{--@can('can-delete')--}}
                                                                        <a href=" {{ url('/dms/delete/sof/'.$sof->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                                        {{--@endcan--}}

                                                                </td>
                                                        </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
{{--                                        @foreach($stages as $stage)--}}
                                        <div class="tab-pane p-20" id="xxxx" role="tabpanel">
                                                @foreach($checklist as $key => $values)
                                                    <h3>{{ ucwords($key) }}</h3>
                                                    <table class="table table-responsive table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th><b>Checklist</b></th>
                                                            <th><b>Type</b></th>
                                                            <th><b>Data</b></th>
                                                            <th><b>Sub checklist</b></th>
                                                            <th><b>Date Added</b></th>
                                                        </tr>
                                                        </thead>
                                                    @foreach($values as $inn)

                                                                <tbody>
                                                                <tr>
                                                                    <th><strong>{{ ucwords($inn[$key]['name'] )}}</strong></th>
                                                                    <th>{{ ucwords($inn[$key]['type']) }}</th>
                                                                    @if($inn[$key]['type'] == 'text')
                                                                        <th>{!!  $inn[$key]['type'] == 'text' ? ucfirst($inn[$key]['text'])  : implode("<br>",$inn[$key]['doc_links'])  !!}</th>
                                                                    @else
                                                                        <th>
                                                                            @foreach($inn[$key]['doc_links'] as $link)
                                                                                <a href="{{ url($link) }}" target="_blank">{{$link}} <br></a>
                                                                            @endforeach
                                                                        </th>
                                                                    @endif
                                                                    <th>{{ $inn[$key]['subchecklist'] != null ? implode(',',json_decode($inn[$key]['subchecklist'])) : ''}}</th>
                                                                    <th>{{ \Carbon\Carbon::parse( $inn[$key]['created_at'])->format('d-M-y') }}</th>
                                                                </tr>
                                                                </tbody>

                                                @endforeach
                                                    </table>
                                                @endforeach
                                            </div>
                                        {{--@endforeach--}}
                                        <div class="tab-pane p-20" id="hixstory" role="tabpanel">
                                            <h4>Quotation History
                                                    <a href="{{ url('quotation/preview/'.$dms->quote_id ) }}" target="_blank" class="btn btn-warning pull-right" style="margin-right: 8px">Preview And Print FDA</a>
                                                {{--@can('manager')--}}
                                                    <a href="{{ url($dms->status != 1 ? 'quotation/'.$dms->quote_id : 'quotation/preview/'.$dms->quote_id ) }}" target="_blank" class="btn btn-success pull-right">{{ $dms->status != 1 ? 'Edit PDA' : 'Preview And Print FDA' }}</a>
                                                {{--@endcan</h4>--}}

                                            <hr>
                                                @if($dms->quote)
                                            <table class="table table-responsive table-stripped">
                                                <thead>
                                                <tr>
                                                    <th><b>Date</b></th>
                                                    <th><b>Project Name</b></th>
                                                    <th><b>Project Amount</b></th>
                                                    <th class="text-right"><b>Action</b></th>
                                                </tr>
                                                </thead>
                                                @foreach($dms->quote->logs as $key => $values)
                                                <tbody>
                                                    <tr>
                                                        <td>{{\Carbon\Carbon::parse($values->created_at)->format('d-M-y H:m:s')}}</td>
                                                        <td>{{json_decode($values->details)->vessel->name}}</td>
                                                        <td>{{ json_decode($values->details)->lead->iCurrencyID ==1 ? 'USD' :'KES' }}, {{collect(json_decode($values->details)->services)->sum('total')}}</td>
                                                        <td class="text-right">
                                                            <a target="_blank" href="{{ url('quotation/preview/'.$dms->quote_id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>

                                                @endforeach
                                            </table>
                                                    @endif
                                        </div>
                                        <div class="tab-pane p-20" id="state" role="tabpanel">
                                            <h4>Voyage Statement</h4>
                                            <hr>
                                            <div class="card card-body">
                                                <h4><B>Project Services Cost</B></h4>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if($dms->quote)
                                                        <table class="table table-stripped">
                                                            <thead>
                                                            <tr>
                                                                <th>Service Name</th>
                                                                <th>Receipt</th>
                                                                <th>Selling Price</th>
                                                                <th>Cost</th>
                                                                <th class="text-right">Profit</th>
                                                                {{--<th>Action</th>--}}
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($dms->quote->services as $service)
                                                                @if($service->buying_price != 0 && $service->buying_price != null)
                                                                    <tr>
                                                                        <td>{{ ucwords($service->description) }}</td>
                                                                        <td><a target="_blank" href="{{ url(asset($service->doc_path == null ? '' : $service->doc_path)) }}">{{ $service->doc_path == null ? '' : 'Download'}}</a></td>
                                                                        <td>{{ number_format($service->total,2)}}</td>
                                                                        <td>{{ $service->buying_price == null ? 'Add Service Cost' : number_format($service->buying_price,2) }}</td>
                                                                        <td class="text-right">{{ $service->buying_price == null ? 'Add Service Cost' : number_format(($service->total - $service->buying_price),2) }}</td>
                                                                        {{--<td>--}}
                                                                        {{--<button data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-xs btn-success" data-dismiss="modal">--}}
                                                                        {{--<i class="fa fa-pencil"></i>--}}
                                                                        {{--</button>--}}
                                                                        {{--</td>--}}
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                            @endif
                                                    </div>
                                                </div>
                                                <h4><b>Fund Requested</b></h4>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if($dms->quote)
                                                        <table class="table table-stripped">

                                                            <thead>
                                                            <tr>
                                                                <th>Employee</th>
                                                                <th>Em NO/ID</th>
                                                                <th>Deadline</th>
                                                                <th>Reason</th>
                                                                <th>S/File</th>
                                                                <th>Status</th>
                                                                <th class="text-right">Amount</th>
                                                                {{--<th>Action</th>--}}
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($dms->quote->pettyCash as $cash)
                                                                @if(\Illuminate\Support\Facades\Auth::id() == $cash->user_id)
                                                                    <tr>
                                                                        <td>{{ ucwords($cash->user->name) }}</td>
                                                                        <td>{{ $cash->employee_number }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($cash->deadline)->format('d-M-y') }}</td>
                                                                        <td>{{ $cash->reason }}</td>
                                                                        <td><a target="_blank" href="{{ asset($cash->file_path) }}">{{ $cash->file_path == ' ' ? '' : 'File' }}</a></td>
                                                                        <td>{{ $cash->status == 0 ? 'Not Approved' : 'Approved' }}</td>
                                                                        <td class="text-right">{{ number_format($cash->amount, 2) }}</td>
                                                                        {{--<td>--}}
                                                                            {{--@if($cash->status == 0)--}}
                                                                                {{--<a href="{{ url('/approve-project-cost-request/'.$cash->id) }}"--}}
                                                                                   {{--class="btn btn-xs btn-primary">approve</a>--}}
                                                                            {{--@endif--}}
                                                                        {{--</td>--}}
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th colspan="3">Total</th>
                                                                <th> EXP: {{ number_format($dms->quote->pettyCash->sum('amount'), 2) }}</th>
                                                                <th>SP : {{ number_format($dms->quote->services->sum('total'), 2) }}</th>
                                                                <th>BP: {{ number_format($dms->quote->services->sum('buying_price'), 2) }}</th>
                                                                <th class="text-right">{{ number_format(($dms->quote->services->sum('total') - ($dms->quote->pettyCash->sum('amount') + $dms->quote->services->sum('buying_price'))), 2) }}</th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="cost" role="tabpanel">
                                            <h4>Project Expense</h4>
                                            <hr>
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button data-toggle="modal" data-target=".bs-example-modal-reqfund" class="btn btn-info">
                                                            Request Fund
                                                        </button>
                                                        <button data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-info">
                                                            Add Project Service Cost
                                                        </button>
                                                        <button style="display: none" data-toggle="modal" data-target=".bs-example-modal-allreqfund" class="btn btn-success">
                                                            View Requested Fund
                                                        </button>

                                                        <button data-toggle="modal" data-target=".bs-example-modal-statement" class="btn btn-success">
                                                            Project Statement
                                                        </button>
                                                    </div>
                                                    <div class="modal fade bs-example-modal-servicecost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Service Cost</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form action="{{ url('service-cost') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                            <div class="row">
                                                                                {{ csrf_field() }}
                                                                                <div class="col-sm-12">
                                                                                    <input type="hidden" name="quotation_id" VALUE="{{ $dms->quote ? $dms->quote->id :''}}">
                                                                                         @if($dms->quote)
                                                                                    <div class="form-group">
                                                                                        <label for="service_id">Select Service</label>
                                                                                        <select name="service_id" id="service_id"
                                                                                                class="form-control" required>
                                                                                            <option value="">Select Service</option>
                                                                                            @foreach($dms->quote->services as $service)
                                                                                                @if($service->buying_price == 0 || $service->buying_price == null)
                                                                                    <option value="{{$service->id}}">{{ ucwords($service->description) }} - {{ $service->total }}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    @endif
                                                                                    <div class="form-group">
                                                                                        <label for="buying_price">Service Buying Amount</label>
                                                                                        <input type="number" required id="buying_price" name="buying_price" class="form-control" placeholder="Service Buying Amount">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="description">Description</label>
                                                                                        <input type="text" required id="description" name="description" class="form-control" placeholder="Description">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="doc_path">Select Supporting Doc</label>
                                                                                        <input type="file" required id="doc_path" name="doc_path" class="form-control" placeholder="Select Supporting Doc">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Add">
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
                                                    <div class="modal fade bs-example-modal-reqfund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Request Fund</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form action="{{ route('project-cost.store') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                            <div class="row">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="project_id" value="{{$dms->quot ? $dms->quote->project_id : ''}}">
                                                                                <div class="col-sm-12">
                                                                                    <input type="hidden" name="quotation_id" VALUE="{{ $dms->quote ? $dms->quote->id : ''}}">
                                                                                    <input type="hidden" name="user_id" VALUE="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                                                                    <div class="form-group">
                                                                                        <label for="employee_number">Employee Number/ID</label>
                                                                                        <input type="text" required id="employee_number" name="employee_number" class="form-control" placeholder="Employee Number/ID">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="amount">Amount Requested</label>
                                                                                        <input type="number" required id="amount" name="amount" class="form-control" placeholder="Amount Requested">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="currency">Currency</label>
                                                                                        <select name="currency_type" id="currency" class="form-control">
                                                                                            <option value="KSH">KSH</option>
                                                                                            <option value="USD">USD</option>

                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="payment_type">Payment Type</label>
                                                                                        <select name="payment_mode" id="payment_type" class="form-control">
                                                                                            @foreach($payment_types as $pt)
                                                                                            <option value="{{$pt->iVoucherTypeID}}">{{$pt->cVoucherName}}</option>
                                                                                                @endforeach

                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="deadline">Deadline</label>
                                                                                        <input type="text" required id="deadline" name="deadline" class="form-control datepicker" placeholder="Deadline">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="reason">Reason</label>
                                                                                        <textarea name="reason" id="reason"
                                                                                                  cols="30" rows="3"
                                                                                                  class="form-control"></textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="file_path">Select Supporting Doc</label>
                                                                                        <input type="file" id="file_path" name="file_path" class="form-control" placeholder="Select Supporting Doc">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Send Request">
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
                                                    <div class="modal fade bs-example-modal-allreqfund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">All Requested Fund</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                @if($dms->quote)
                                                                                <table class="table table-stripped">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Employee</th>
                                                                                        <th>Em NO/ID</th>
                                                                                        <th>Deadline</th>
                                                                                        <th>Reason</th>
                                                                                        <th>S/File</th>
                                                                                        <th>Status</th>
                                                                                        <th>Amount</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($dms->quote->pettyCash as $cash)
                                                                                        @if(\Illuminate\Support\Facades\Auth::id() == $cash->user_id)
                                                                                            <tr>
                                                                                                <td>{{ ucwords($cash->user->name) }}</td>
                                                                                                <td>{{ $cash->employee_number }}</td>
                                                                                                <td>{{ \Carbon\Carbon::parse($cash->deadline)->format('d-M-y') }}</td>
                                                                                                <td>{{ $cash->reason }}</td>
                                                                                                <td><a target="_blank" href="{{ asset($cash->file_path) }}">{{ $cash->file_path == ' ' ? '' : 'File' }}</a></td>
                                                                                                <td>{{ $cash->status == 0 ? 'Not Approved' : 'Approved' }}</td>
                                                                                                <td>{{ number_format($cash->amount, 2) }}</td>
                                                                                                <td>
                                                                                                    @can('manager')
                                                                                                    @if($cash->status == 0)
                                                                                                        <a href="{{ url('/approve-project-cost-request/'.$cash->id) }}"
                                                                                                           class="btn btn-xs btn-primary">approve</a>
                                                                                                    @endif
                                                                                                    @endcan
                                                                                                        <a href="{{url('view-q',['id'=>$cash->id])}}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @else
                                                                                        @can('manager')
                                                                                            <tr>
                                                                                                <td>{{ ucwords($cash->user->name) }}</td>
                                                                                                <td>{{ $cash->employee_number }}</td>
                                                                                                <td>{{ \Carbon\Carbon::parse($cash->deadline)->format('d-M-y') }}</td>
                                                                                                <td>{{ $cash->reason }}</td>
                                                                                                <td><a target="_blank" href="{{ asset($cash->file_path) }}">{{ $cash->file_path == ' ' ? '' : 'File' }}</a></td>
                                                                                                <td>{{ $cash->status == 0 ? 'Not Approved' : 'Approved' }}</td>
                                                                                                <td>{{$cash->currency_type=='USD' ? '$' : 'KSH'}}{{ number_format($cash->amount, 2) }}</td>
                                                                                                <td>
                                                                                                    @can('manager')
                                                                                                    @if($cash->status == 0)
                                                                                                        <a href="{{ url('/approve-project-cost-request/'.$cash->id) }}"
                                                                                                           class="btn btn-xs btn-primary">approve</a>
                                                                                                    @endif
                                                                                                    @endcan
                                                                                                        <a href="{{url('view-q',['id'=>$cash->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endcan
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                    {{--@if(\Illuminate\Support\Facades\Auth::id() == $cash->user_id)--}}
                                                                                    <tr>
                                                                                        <th colspan="6">Total</th>
                                                                                        <th>{{ $dms->quote ? number_format($dms->quote->pettyCash->sum('amount'), 2) : ''}}</th>
                                                                                    </tr>
                                                                                    </tfoot>
                                                                                    {{--@endif--}}
                                                                                </table>
                                                                                    @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade bs-example-modal-statement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Project Statement</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">

                                                                                @if($dms->quote)
                                                                                <table class="table table-stripped">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Service Name</th>
                                                                                        <th>Total Excl</th>
                                                                                        <th>Total Incl</th>
                                                                                        <th>Cost</th>
                                                                                        <th>GP Amount</th>
                                                                                        <th>GP %</th>
                                                                                        <th class="text-right">Profit</th>
                                                                                        <th>Status</th>
                                                                                        {{--<th>Action</th>--}}
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <?php $bp = 0?>
                                                                                    <tbody>
                                                                                    @foreach($dms->quote->services as $service)
                                                                                        <?php $bp +=(float)$service->buying_price?>
                                                                                        <tr>
                                                                                            <td>{{ ucwords($service->description) }}</td>
                                                                                            <td>{{ number_format($service->total_excl,2)}}</td>
                                                                                            <td>{{ number_format($service->total,2)}}</td>
                                                                                            <td>{{ number_format($service->buying_price,2) }}</td>
                                                                                            <td>{{ number_format($service->gp,2) }}</td>
                                                                                            <td>{{ number_format($service->gp_percentage,2) }}</td>
                                                                                            <td class="text-right">{{ number_format(($service->total_excl - $service->buying_price),2) }}</td>
                                                                                             <td>UNPOSTED</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                    <tr>
                                                                                        <th colspan="1">Total</th>
                                                                                        <th>{{ number_format($dms->quote->services->sum('total_excl'), 2) }}</th>
                                                                                        <th>{{ number_format($dms->quote->services->sum('total'), 2) }}</th>
                                                                                        <th>{{ number_format($dms->quote->services->sum('buying_price'), 2)  }}</th>
                                                                                        <th class="text-right">{{ number_format($dms->quote->services->sum('gp') ,2) }}</th>
                                                                                        <th class="text-right">{{ number_format($dms->quote->services->sum('gp_percentage') ,2) }}</th>
                                                                                        <th>{{ number_format((float)$dms->quote->services->sum('total_excl'), 2) - $bp}}</th>

                                                                                    </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                                    @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button style="display: none" data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-info" data-dismiss="modal">
                                                                        Add Project Service Cost
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if($dms->quote)
                                                        <h4>Purchase Orders <a href="{{ url('generate-po/'.$dms->quote->id) }}" class="btn btn-info btn-sm pull-right">
                                                                Generate Purchase Order
                                                            </a></h4>
                                                            @endif
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-stripped">
                                                            @if($dms->quote)
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Supplier</th>
                                                                <th>Created By</th>
                                                                <th>Status</th>
                                                                <th>PO Date</th>
                                                                {{--@can('managerd')--}}
                                                                <th class="text-right">Action</th>
                                                                {{--@endcan--}}
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($dms->quote->purchaseOrder as $po)
                                                                <tr>
                                                                    <td>{{ strtoupper($po->po_no) }}</td>
                                                                    <td>{{ ucwords($po->supplier->Name) }}</td>
                                                                    <td>{{ ucwords($po->user->name) }}</td>
                                                                    <td><button class="btn btn-xs btn-{{ $po->status == \Esl\helpers\Constants::PO_REQUEST ? 'primary' : ($po->status == \Esl\helpers\Constants::PO_APPROVED ? 'success' : 'danger') }}">{{ ucwords($po->status) }}</button></td>
                                                                    <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d-M-y') }}</td>
                                                                    <td class="text-right"><a href="{{ url('/view-po/'. $po->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($dms->status != 1)
                                        <a href="{{ url('/dms/complete/'.$dms->id) }}" class="btn pull-right btn-warning text-white mytooltip">
                                            Complete Project <span class="tooltip-content3">
                                                Are you sure??.</span></a>
                                        @endif
                                </div>
                            </div>
                            @foreach($stages as $stage)
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ ucwords($stage->name) }}</h4>
                                            <table class="table table-stripped">
                                                <tbody>
                                                @foreach($stage->components as $component)
                                                    @if(!in_array($component->id,$stageids))
                                                    <form action="{{ url('/dms/store/') }}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                    <tr>
                                                        <td><div class="row">
                                                                <div class="col-sm-4">
                                                                    {{ ucfirst($component->name) }}
                                                                </div>
                                                                <input type="hidden" name="stage_component_id[]" value="{{$component->id}}">
                                                                <input type="hidden" name="dms_id" value="{{$dms->id}}">
                                                                <div class="col-sm-6 form-group">
                                                                    <input name="{{  $component->type == 'file' ? 'doc_links' : 'text_value'}}[{{$component->id}}][]" class="form-control" {{ $component->required == true ? 'required' : '' }} type="{{ $component->type == 'file' ? 'file' : 'text' }}" multiple {{ $component->type == 'file' ? 'multiple' : '' }} >
                                                                </div>
                                                                @if($component->components != null )
                                                                    <div class="col-sm-2">
                                                                        <i class="btn btn-success model_img img-responsive fa fa-check" data-toggle="modal" data-target="#responsive-modal{{$component->id}}">Sub checklist</i>
                                                                        <!-- sample modal content -->
                                                                        <div id="responsive-modal{{$component->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">{{ ucwords($stage->name)  }} Sub checklist</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="col-sm-12">
                                                                                            <ul class="icheck-list">
                                                                                                @foreach(json_decode($component->components) as $item)
                                                                                                    <div class="form-group">
                                                                                                        <input type="checkbox" name="checklist[{{$component->id}}][{{$item}}][]" class="check" id="{{$item}}">
                                                                                                        <label for="{{$item}}">{{ $item }}</label>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div></td>
                                                        <td><button class="btn btn-primary pull-right">Complete</button></td>
                                                    </tr>
                                                    </form>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                                    {{--@endif--}}
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add SOF </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="checklist" action="{{ url('dms/add/sof') }}" onsubmit="event.preventDefault(); addSof(this, '{{ url('dms/add/sof') }}')" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12">
                                    @if($dms->quote)
                                    <div class="form-group">
                                        <label for="consignee_id">Select Consignee</label>
                                        <select name="consignee_id" id="consignee_id" class="form-control">
                                            @foreach($dms->quote->cargos as $consignee)
                                                <option value="{{$consignee->consignee->id}}">{{$consignee->consignee->consignee_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                @endif
                                </div>

                                <div class="col-sm-4">
                                    <input type="hidden" name="bill_of_landing_id" value="{{ $dms->id }}">
                                    <div class="form-group">
                                        <label for="from">From (Date)</label>
                                        <input type="text"  required id="from" name="from" class="datepicker form-control" placeholder="From">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="to">To (Date)</label>
                                        <input type="text" required id="to" name="to" class="datepicker form-control" placeholder="To">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="total_cranes">Total Cranes</label>
                                        <input type="number"  required id="total_cranes" name="total_cranes" class="form-control" placeholder="Total Cranes">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">From (Time)</label>
                                        <input type="text" required id="from_time" name="from_time" class="timepicker1 form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">To (Time)</label>
                                        <input type="text" required id="to_time" name="to_time" class="timepicker1 form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="crane_working">Cranes Working</label>
                                        <input type="number"  required id="crane_working" name="crane_working" class="form-control" placeholder="Crane Working">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="consignee_id">Action</label>
                                        <select name="action" id="action" required class="form-control">
                                            <option value="">Select Action</option>
                                            <option value="calculate">Used for calculation</option>
                                            <option value="not_used">Normal Entry</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" id="remarks" cols="5" required rows="3"
                                                      class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
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
    <div class="modal fade bs-example-modal-dms" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update Details </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h4>Update Profoma Disbursement Account</h4>
                            <div class="col-12">
                                <form style="text-align: left !important;" id="update_service{{$dms->id}}" action="{{ url('/update-dms') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="description text-left">Client Name</label>
                                                <input type="text" value="{{ ucwords($dms->customer->Name) }}" readonly disabled class="form-control">
                                            </div>
                                            {{--<div class="form-group">--}}
                                            {{--<label for="code_name">Code Name</label>--}}
                                            {{--<input type="text" required id="code_name" name="code_name" class="form-control">--}}
                                            {{--</div>--}}
                                            <div class="form-group">
                                                <label for="seal_number">Seal Number</label>
                                                <input type="text" required value="{{$dms->seal_number}}" id="seal_number" name="seal_number" class="form-control">
                                            </div>
                                            {{--TODO berth number update--}}
                                            <div class="form-group">
                                                <label for="berth_number">Berth Number</label>
                                                <input type="text" required value="{{$dms->berth_number}}" id="berth_number" name="berth_number" class="form-control">
                                            </div>
                                            @if($dms->quote)
                                            @foreach($dms->quote->cargos as $cargo)
                                                <div class="form-group">
                                                    <label for="cargo_bl">Update ({{$cargo->name}}) Cargo For {{ucwords($cargo->consignee->consignee_name)}} BL Number</label>
                                                    <input type="text" required id="cargo_bl" value="{{$cargo->bl_no}}" name="cargo_bl[{{$cargo->id}}]" class="form-control">
                                                </div>
                                            @endforeach
                                            @endif
                                            <div class="form-group">
                                                <label for="eta">Update ETA Date</label>
                                                <input type="text" required value="{{\Carbon\Carbon::parse($dms->vessel->eta)->format('m/d/Y')}}" id="eta" name="eta" class="datepicker form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="eta_time">Update ETA Time</label>
                                                <input type="text" required value="{{\Carbon\Carbon::parse($dms->vessel->eta)->format('H:i:s')}}"  id="eta_time" name="eta_time" class="timepicker1 form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="laytime_start">Lay Time Start(Date)</label>
                                                <input type="text" required value="{{\Carbon\Carbon::parse($dms->laytime_start)->format('m/d/Y')}}" id="laytime_start" name="laytime_start" class="datepicker form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="laytime_time">Lay Time Start(Time)</label>
                                                <input type="text" required value="{{\Carbon\Carbon::parse($dms->laytime_time)->format('H:i:s')}}" id="laytime_time" name="laytime_time" class="timepicker1 form-control">
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="place_of_receipt">Place of Receipt</label>
                                                <input type="text" required id="place_of_receipt" name="place_of_receipt" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="ata">Update ATA Date</label>
                                                <input type="text" value="{{$dms->quote->voyage ? $dms->quote->voyage->vessel_arrived : ''}}"  required id="ata" name="ata" class="datepicker form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="ata_time">Update ATA Time</label>
                                                <input type="text" required value="{{ $dms->quote->voyage ? $dms->quote->voyage->vessel_arrived : ''}}"  id="ata_time" name="ata_time" class="timepicker1 form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_of_loading">NOR Date</label>
                                                <input type="text" required value="{{\Carbon\Carbon::parse($dms->date_of_loading)->format('m/d/Y')}}" id="date_of_loading" name="date_of_loading" class="datepicker form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_of_loading_time">NOR Time</label>
                                                <input type="text" required id="date_of_loading_time" value="{{\Carbon\Carbon::parse($dms->date_of_loading_time)->format('H:i:s')}}" name="date_of_loading_time" class="timepicker1 form-control">
                                            </div>
                                            <input type="hidden" name="dms_id" value="{{ $dms->id }}">
                                            <div class="form-group">
                                                <label for="time_allowed">Time Allowed</label>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group"><label for="days">Number of Days</label>
                                                                    <input required value="{{ explode(",",(new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed))))->format('%a, %h, %i, %s'))[0]   }}" type="number" name="days" id="days" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group"><label for="days">Number of Hours</label>
                                                                    <input required value="{{ explode(",",(new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed))))->format('%a, %h, %i, %s'))[1]   }}" type="number" name="hour" id="hour" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group"><label for="hours">Number of Mins</label>
                                                                    <input required value="{{ explode(",",(new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed))))->format('%a, %h, %i, %s'))[2]   }}" type="number" name="min" id="min" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group"><label for="hours">Number of Secs</label>
                                                                    <input required value="{{ explode(",",(new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed))))->format('%a Days, %h Hours, %i Minutes, %s Seconds'))[3]   }}" type="number" name="sec" id="sec" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="number_of_crane">Total Number of Cranes </label>
                                                <input type="number" required id="number_of_crane" name="number_of_crane" class="form-control" placeholder="Total Number of Cranes">
                                            </div>
                                            <div class="form-group">
                                                <label for="">**Note you can still make Changes later</label>
                                                <input class="btn pull-right btn-primary" type="submit" value="Update">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
@endsection
@section('scripts')
    <script>

        $(function(){
         $('.hours').on('keyup',function(){        
           if($(this).val() < 1){            
           $(this).val(1);            
           }
        })

        $('.hours').on('click',function(){          
           if($(this).val() < 1){          
           $(this).val(1);          
           }
        })

         $('.mins').on('keyup',function(){        
           if($(this).val() < 1){            
           $(this).val(1);            
           }
        })

        $('.mins').on('click',function(){          
           if($(this).val() < 1){          
           $(this).val(1);          
           }
        })

         $('.secs').on('keyup',function(){        
           if($(this).val() < 1){            
           $(this).val(1);            
           }
        })

        $('.secs').on('click',function(){          
           if($(this).val() < 1){          
           $(this).val(1);          
           }
        })

         $('.cranes').on('keyup',function(){        
           if($(this).val() < 1){            
           $(this).val(1);            
           }
        })

        $('.cranes').on('click',function(){          
           if($(this).val() < 1){          
           $(this).val(1);          
           }
        })

         $('.days').on('keyup',function(){        
           if($(this).val() < 1){            
           $(this).val(1);            
           }
        })

        $('.days').on('click',function(){          
           if($(this).val() < 1){          
           $(this).val(1);          
           }
        })

        })

        $('.timepicker1').timepicker({'showMeridian':false});
        function alertTransport() {
            alert('Email with required documents sent to Transport');
        }

        function deleteRow(id) {
            $('#'+id).remove()
        }

        function resetCfs() {
            window.location.reload();
        }
        function addSof(form, formUrl){

            var formId = form.id;

            var vessel = $('#'+formId);

            console.log(vessel);

            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            console.log(data);
            axios.post(formUrl, data)
                .then(function (response) {
                    var details = response.data.success;

                    $('#sof_list').empty().append('' +
                        '<div class="col-sm-12 text-center"><button onclick="resetCfs()" class="btn btn-primary">Refresh</button></div>');
                    document.getElementById(formId).reset();
                    if(details === 'error'){
                        swal("Oops",response.data.error, "error");
                    }
                    else {
                        swal("Good job!", "Add another entry", "success");
                    }

                    $('#'+formId).reset();
//                    $('#modal').modal('hide');
//                    window.location.reload();
                })
                .catch(function (response) {
                    console.log(response.data);
                });

        }
    </script>
@endsection
