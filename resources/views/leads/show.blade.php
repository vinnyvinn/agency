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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lead {{ ucwords($lead->name) }}</h4>
                        <table class="table table-borded">
                            <tr>
                                <td><strong>Name : </strong> {{ ucwords($lead->name) }}</td>
                                <td><strong>Contact Person : </strong> {{ ucwords($lead->contact_person) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address 1: </strong> {{ $lead->cPhysicalAddress1 }} </td>
                                <td><strong>Address 2: </strong> {{ $lead->cPhysicalAddress2 }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telephone : </strong> {{ $lead->telephone }}</td>
                                <td><strong>Phone : </strong> {{ $lead->phone }}</td>
                            </tr>
                        </table>
                        @if(count($quotations->quotation)<1)
                            <div class="row">
                                    @can('generate-quotation')
                                    <div class="col-sm-6">
                                        <a href="{{ url('/customer-request/'.$lead->id.'/'.\Esl\helpers\Constants::LEAD_CUSTOMER) }}" class="btn btn-primary">Gen. Quotation</a>
                                    </div>
                                @endcan
                                    @can('admin')
                                            <div class="col-sm-6">
                                                <form action="{{url('/customer-request/'.$lead->id.'/000')}}" method="get">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <select name="type" width="100%" id="type" class="select2 form-control">
                                                                    <option value="">Select Service to Quote</option>
                                                                    @foreach(\App\ExtraServiceType::all()->sortBy('name') as $value)
                                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button class="btn btn-primary pull-right">Specific Quotation</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                {{--                                        <a href="{{ url('/customer-request/'.$lead->id.'/'.\Esl\helpers\Constants::LEAD_CUSTOMER) }}" class="btn btn-primary">Generate Quotation</a>--}}
                                            </div>
                                            @endcan
                            </div>
                            @endif
                    </div>
                </div>
                @can('view-quotation')
                <div class="card">
                    <div class="card-body">
                        <h3>Lead Quotations</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Vessel</th>
                                    <th>Quotation Status</th>
                                    <th>Created On</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($quotations->quotation as $quotation)
                                        <tr>
                                            <td>ESL00{{ ucwords($quotation->id) }}</td>
                                            <td>{{ ucfirst($quotation->vessel->name) }}</td>
                                            <td>{{ ucfirst($quotation->status) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</td>
                                            <td class="text-right">
                                                    <a href=" {{ url('/quotation/'. $quotation->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    @endcan
            </div>
        </div>
    </div>
@endsection

