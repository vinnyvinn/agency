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
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="card-title text-white">Active Jobs</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency" id="tbl-agency">
                                <thead>
                                <tr>
                                    {{--<th>BL</th>--}}
                                    <th>Customer</th>
                                    <th>Vessel Name</th>
                                    <th>Voyage No</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    @if($dm->status == 0 && $dm->customer != null)
                                        <tr>
                                            {{--<td>{{ $dm->bl_number }}</td>--}}
                                            <td>{{ ucwords($dm->customer->Name) }}</td>
                                            <td>{{ strtoupper($dm->vessel->name) }}</td>
                                            <td>{{ strtoupper($dm->quote->voyage->voyage_no) }}</td>
{{--                                            <td>{{ ucwords($dm->vessel->port_of_discharge ) }}, {{ ucwords($dm->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($dm->vessel->port_of_loading ) }}, {{ ucwords($dm->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $dm->quote == null ? 0 : $dm->quote->cargos->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                                <a href=" {{ url('dms/edit/'. $dm->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>
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
                        <h4 class="card-title text-white">Completed Jobs</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency" id="tbl-agency">
                                <thead>
                                <tr>
                                    {{--<th>BL</th>--}}
                                    <th>Customer</th>
                                    <th>Vessel Name</th>
                                    <th>Voyage No</th>
                                    {{--<th>Port Of Discharge</th>--}}
                                    {{--<th>Port Of Loading</th>--}}
                                    {{--<th>Cargo Weight</th>--}}
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    @if($dm->status == 1 && $dm->customer != null)
                                        <tr>
                                            {{--<td>{{ $dm->bl_number }}</td>--}}
                                            <td>{{ ucwords($dm->customer->Name) }}</td>
                                            <td>{{ strtoupper($dm->vessel->name) }}</td>
                                            <td>{{ $dm->quote ? strtoupper($dm->quote->voyage->voyage_no) : '' }}</td>
{{--                                            <td>{{ ucwords($dm->vessel->port_of_discharge ) }}, {{ ucwords($dm->vessel->country_of_discharge ) }}</td>--}}
{{--                                            <td>{{ ucwords($dm->vessel->port_of_loading ) }}, {{ ucwords($dm->vessel->country_of_loading ) }}</td>--}}
{{--                                            <td>{{ $dm->quote->cargos->sum('weight')}}</td>--}}
                                            {{--                                        <td>{{ $dm->stage }}</td>--}}
                                            <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                                <a href=" {{ url('dms/edit/'. $dm->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>
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
