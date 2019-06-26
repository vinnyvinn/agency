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
                @foreach($data as $datum)
                <div id="{{strtoupper($datum['bl_no'])}}" class="{{strtoupper($datum['bl_no'])}} card card-body">
                    <div class="Section1" style="background-color: white !important;" width="100%">
                        <div class="row">
                            <div class="col-sm-12">
                                <img style="padding: 20px;" src="{{ asset('images/esl.png') }}" alt="" width="100%" height="auto">
                            </div>
                        </div>
                        <div class="row" style="background-color: blue">
                            <div class="col-sm-12">
                                <h3 class="text-center" style="margin: 0px;padding: 16px; text-align: center !important;"><strong style="color: black !important; text-align: center !important;"> {{ strtoupper($title) }} MANIFEST </strong> </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <table width="100%">
                                <tbody>
                                <tr>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Vessel: {{ strtoupper($client['vessel_name'])  }}</p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Voyage No: {{strtoupper($client['voyage']) }}</p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Nationality of Vessel: {{  strtoupper($client['voyage_nationality'])  }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Port of Loading: {{ strtoupper($client['port_of_loading'])  }}</p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">E.T.A: {{ \Carbon\Carbon::parse($client['eta'])->format('d.m.Y') }}</p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Transhipment Port: </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Port of Discharge: {{ strtoupper($client['port_of_discharge'])  }}</p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px"></p>
                                    </td>
                                    <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                        <p style="font-size: 10px;font-weight: bold">Place of Delivery: {{ strtoupper($client['port_of_discharge'])  }}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <table width="100%">
                                <thead>
                                <tr>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>B/L No</h4></th>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>Shipper / Consignee / Notify Party</h4></th>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>Container No. / Seal No.</h4></th>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>Description</h4></th>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>Gross Wt(KGs)</h4></th>
                                    <th style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;"><h4>Volume(Cubic Meters)</h4></th>
                                </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px">{{ strtoupper($datum['bl_no'])  }}</p>
                                            </td>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px;"> <b style="font-weight: bold">Shipper: <br></b>{!! strtoupper(str_replace(",","<br>",$datum['shipper'])) !!}
                                                    <br>
                                                    <br>
                                                    <b style="font-weight: bold">Consignee: <br></b>{!! strtoupper(str_replace(",","<br>",$datum['consignee'])) !!}
                                                    <br>
                                                    <br>
                                                    <b style="font-weight: bold">Notify Party: <br></b>{!! strtoupper(str_replace(",","<br>",$datum['party'])) !!}
                                                </p>
                                            </td>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px;font-weight: bold">{{  strtoupper($datum['marks'])  }}</p>
                                            </td>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px;font-weight: bold">{!!   strtoupper(str_replace(",","<br>",$datum['description']))  !!} </p>
                                            </td>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px;font-weight: bold">{{  number_format(($datum['weight'] * 1000),2)  }}</p>
                                            </td>
                                            <td style="padding-left: 8px !important; width: 33%; border: 1px solid black !important;">
                                                <p style="font-size: 10px;font-weight: bold">{{  number_format($datum['weight'],2)  }}</p>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <br>
                                <br>
                                <h4 class="text-right">{{ $loop->iteration }} / {{ count($data) }}</h4>
                            </div>
                        </div>
                    </div>
                        <br>
                        <br>
                        <br>
                </div>
                <div class="text-right">
                    <button onclick="printIw('{{strtoupper($datum['bl_no'])}}')" class="{{strtoupper($datum['bl_no'])}} btn btn-success" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function printIw(divid) {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };

            $("#"+divid).printArea(options);

            $("."+divid).hide();
        };
    </script>
@endsection
