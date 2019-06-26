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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <img style="padding: 20px;" src="{{ asset('images/esl.png') }}" alt="" width="100%" height="auto">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-center"><strong>CANNON TOWERS 6TH FLOOR, BANDARI WING <br>
                                                    MOI AVENUE, MOMBASA KENYA. <br>
                                                    EMAIL : agency@esl-eastafrica.com or ops@esl-eastafrica.com</strong> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <table class="table table-bordered table-condensed">
                                                <tr>
                                                    <td width="auto"><strong>VESSEL NAME </strong></td>
                                                    <td>{{ucwords($data[2]['vesselname'])}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>BL NUMBER </strong></td>
                                                    <td>{{ucwords($data[2]['bl'])}}</td>
                                                </tr><tr>
                                                    <td><strong>SUPPLIER </strong></td>
                                                    <td>{{ ucwords($data[2]['supplier']) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Consignee </strong></td>
                                                    <td>{{ ucwords($data[2]['consignee']) }}</td>
                                                </tr><tr>
                                                    <td><strong>CARGO TYPE</strong></td>
                                                    <td>BULK CLINKER</td>
                                                </tr><tr>
                                                    <td><strong>CARGO QTY</strong></td>
                                                    <td>{{ $data[2]['weight'] }} MT</td>
                                                </tr><tr>
                                                    <td><strong>VESSEL ARRIVED</strong></td>
                                                    <td>{{ $data[2]['arrive'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>CARGO DISCHARGE</strong></td>
                                                    <td>{{ $data[2]['weight'] }} MT</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>DISCHARGE RATE</strong></td>
                                                    <td>{{ $data[2]['rate'] }} MT/WWD</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TIME ALLOWED</strong></td>
                                                    <td>{{ explode(",",$data[2]['time'])[0]. ' Days, '. explode(",",$data[2]['time'])[1]. ' Hours, '.explode(",",$data[2]['time'])[2]. ' Mins, '.explode(",",$data[2]['time'])[3]. ' Secs'   }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>DEMURRAGE/DISPATCH RATE</strong></td>
                                                    <td>AS PER CP</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>LAYTIME TO COUNT FROM</strong></td>
                                                    <td>{{ \Carbon\Carbon::parse($data[2]['ltime'])->format('d-M-y H:i')}}</td>
                                                </tr>
                                            </table>
                                    </div>
                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="3" class="text-center">LAYTIME USED</th>
                                                <th colspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th>DAY</th>
                                                {{--<th>DATE</th>--}}
                                                <th>PERIOD</th>
                                                <th>TIME TO COUNT</th>
                                                <th>DAYS</th>
                                                <th>HOURS</th>
                                                <th>MIN</th>
                                                <th>SEC</th>
                                                <th colspan="2">REMARKS</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data[1] as $laytime)
                                                <tr>
                                                    <td>{{ $laytime['day'] }}</td>
                                                    {{--<td>{{ $laytime['date'] }}</td>--}}
                                                    <td>{{ $laytime['period'] }}</td>
                                                    <td>{{ $laytime['time_to_count'] }} %</td>
                                                    <td>{{ explode(',',$laytime['days'])[0]}}</td>
                                                    <td>{{ explode(',',$laytime['days'])[1]}}</td>
                                                    <td>{{ explode(',',$laytime['days'])[2]}}</td>
                                                    <td>{{ explode(',',$laytime['days'])[3]}}</td>
                                                    <td colspan="2">{{ ucfirst($laytime['remarks']) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="9"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="9"></td>
                                            </tr>
                                            <tr style="background-color: #ffcc00 !important;">
                                                <th colspan="4" class="text-center">
                                                    <strong >TOTAL DAYS / LAYTIME USED</strong>
                                                </th>
                                                <th>{{ explode(',',$data[0]['laytimeused'])[0]}}</th>
                                                <th>{{ explode(',',$data[0]['laytimeused'])[1]}}</th>
                                                <th>{{ explode(',',$data[0]['laytimeused'])[2]}}</th>
                                                <th>{{ explode(',',$data[0]['laytimeused'])[3]}}</th>
                                                <th ></th>
                                            </tr>
                                            <tr style="background-color: #ff9900 !important;">
                                                <th colspan="4" class="text-center">
                                                    <strong >TIME ALLOWED</strong>
                                                </th>
                                                <th>{{ explode(',',$data[0]['timeallowed'])[0]}}</th>
                                                <th>{{ explode(',',$data[0]['timeallowed'])[1]}}</th>
                                                <th>{{ explode(',',$data[0]['timeallowed'])[2]}}</th>
                                                <th>{{ explode(',',$data[0]['timeallowed'])[3]}}</th>
                                                <th colspan="2"></th>
                                            </tr>
                                            <tr style="background-color: #ff6600 !important;">
                                                <th colspan="4" class="text-center">
                                                    <strong >TIME SAVED / DISPATCH EARNED</strong>
                                                </th>
                                                <th>{{ explode(',',$data[0]['timesave'])[0]}}</th>
                                                <th>{{ explode(',',$data[0]['timesave'])[1]}}</th>
                                                <th>{{ explode(',',$data[0]['timesave'])[2]}}</th>
                                                <th>{{ explode(',',$data[0]['timesave'])[3]}}</th>
                                                <th colspan="2"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center">
                                            ALL WORKINGS AND TERMS CONSIDERED ARE GIVEN WITHOUT PREJUDICE BASED ON AVAILABLE INFORMATION ONLY AND ARE FOR REFERENCE ONLY. ERRORS &OMISSIONS EXEMPTED
                                        </h5>
                                    </div>
                                </div>
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
