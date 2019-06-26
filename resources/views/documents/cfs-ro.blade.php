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
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-body printableArea">
                    <div style="background-color: white !important;" width="100%">
                        <div class="row">
                            <div class="col-sm-12">
                                <img style="padding: 20px;" src="{{ asset('images/esl.png') }}" alt="" width="100%" height="auto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center"><strong>CFS RELEASE ORDER </strong> </h3>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-2 my-3">
                                <p>THE MANAGING DIRECTOR</p>
                                <p>KENYA PORTS AUTHORITY</p>
                                <p>P.O BOX 95009</p>
                                <p>MOMBASA</p>

                            </div>
                          <div class="col-md-4 ml-auto text-center mb-10">
                              <p class="pull-right "><strong>DATE: {{\Carbon\Carbon::now()->format('d.m.Y') }}</strong></p>
                          </div>

                        </div>
                        <div class="row">
                                <h4><b>PLEASE DELIVER THE FOLLOWING CARGO TO: {{ strtoupper($client['client']) }} </b> </h4>
                        </div>
                        <div class="row">
                                <table class="table table-bordered" style="border:1px !important; border-color:#000000 !important;">
                                    <thead>
                                    <tr>
                                        <th><h4><b>VESSEL NAME</b></h4></th>
                                        <th><h4><b>VOYAGE</b></h4></th>
                                        <th><h4><b>MANIFEST NUMBER</b></h4></th>
                                        <th><h4><b>ETA</b></h4></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ strtoupper($client['vessel_name']) }}</td>
                                        <td>{{ strtoupper($client['voyage']) }}</td>
                                        <td>{{ strtoupper($client['manifest']) }}</td>
                                        <td>{{ strtoupper(\Carbon\Carbon::parse($client['eta'])->format('d.m.Y')) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><h4><b>BL</b></h4></th>
                                    <th><h4><b>DESCRIPTION</b></h4></th>
                                    <th><h4><b>MARKS & NUMBERS</b></h4></th>
                                    <th><h4><b>WEIGHT(KGS)</b></h4></th>
                                    <th><h4><b>PORT OF LOADING</b></h4></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr>
                                        <td>{{ strtoupper($datum['bl_no'])  }}</td>
                                        <td>{!! str_replace(",","<br>",strtoupper($datum['description']))  !!}</td>
                                        <td>{{ strtoupper($datum['marks']) }}</td>
                                        <td>{{ strtoupper(number_format(($datum['weight'] * 1000), 2)) }}</td>
                                        <td>{{ strtoupper($client['port_of_loading']) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3"><strong>TOTAL</strong></th>
                                    <th>{{ number_format((collect($data)->sum('weight') * 1000),2) }}</th>
                                    {{--<th>{{ strtoupper($client['country']) }}</th>--}}
                                    <th> </th>
                                </tr>
                                </tfoot>
                            </table>
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
