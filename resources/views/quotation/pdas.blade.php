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
            <div class="col-12">
                <div class="card card-outline-inverse">
                    <div class="card-header">
                        <h4 class="card-title text-white">Pending PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--Search : <input type="text" id="search_lead">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_PENDING)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
                                            {{--<td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                                <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="card-title text-white">Checked PDAs</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_CHECKED)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                                <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="card-title text-white">Approved PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
{{--                                            <td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="card-title text-white">Requested PDAs</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                     <th>Email</th>
                                    <th>Vessel Name</th>
                                     <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-default">
                    <div class="card-header">
                        <h4 class="card-title">Waiting PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
                                            {{--<td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h4 class="card-title text-white">Accepted PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
{{--                                            <td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-danger">
                    <div class="card-header">
                        <h4 class="card-title text-white">Disapproved PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_DECLINED)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
{{--                                            <td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-danger">
                    <div class="card-header">
                        <h4 class="card-title text-white">Rejected PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_DECLINED_CUSTOMER)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
{{--                                            <td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                            <a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h4 class="card-title text-white">Won PDAs</h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                        {{--Search : <input type="text" id="search_lead">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    {{--<th>Phone</th>--}}
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    {{--<th class="text-nowrap">Action</th>--}}
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($pdas as $pda)
                                    @if($pda->status == \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                        <tr>
                                            <td>{{$pda->id}}</td>
                                            <td>{{ ucwords($pda->lead->name) }}</td>
                                            <td>{{ strtoupper($pda->lead->contact_person) }}</td>
{{--                                            <td>{{ strtoupper($pda->lead->phone) }}</td>--}}
                                            <td>{{ strtoupper($pda->lead->email) }}</td>
                                            <td>{{ strtoupper($pda->vessel->name) }}</td>
{{--                                            <td>{{ ucwords($pda->vessel->port_of_discharge ) }}, {{ ucwords($pda->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($pda->vessel->port_of_loading ) }}, {{ ucwords($pda->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $pda->cargo == null ? ' ' : $pda->cargo->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
                                            {{--<td class="text-nowrap">--}}
                                            {{--<a href=" {{ url('quotation/'. $pda->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>--}}

                                            {{--</td>--}}
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var customer = $('#search_lead');

        customer.on('keyup', function () {
            axios.post('{{ url('/search-dms') }}',{
                'search_item': customer.val()
            }).then( function (response) {
                $('#customers').empty().append(response.data.output);
            })
                .catch( function (error) {
                    console.log(error)
                });
        });
    </script>
@endsection
