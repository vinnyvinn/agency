@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                <p style="font-size: smaller"><br> Powering Our Customers to be Leaders in their Markets</p>
                                <h4>Cannon Towers, <br>6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email : agency@esl-eastafrica.com<br>
                                    Web: www.esl-eastafrica.com</h4>
                                <br>
                                <h4>Tax Registration: P051153405J</h4>
                               <h4>Telephone: +254 41 2229784</h4>


                            </address>
                        </div>

                    </div>


                    <div class="col-sm-12">
                        <div class="pull-right">
                            <h3 class="cash-r">Cash Request</h3>
                            <br>
                            <p><b>Vessel name:</b> {{$quote->quotation->vessel->name}}</p>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>DESCRIPTION</th>

                                        <th class="text-right">TOTAL AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                           <tr id="{{$quote->id}}">
                                            <td> {{ ucwords($quote->reason) }} </td>

                                            <td class="text-right">{{$quote->currency_type=='USD' ? '$' : 'KSH'}}{{ number_format($quote->amount, 2) }}</td>
                                        </tr>
                                       </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div>
                            <address id="client_details text-left">
                                <p>
                                <br><b>Requested by :</b> {{ ucwords($quote->user->name)  }}</p>
                                {{--                                <p><b>Checked by :</b> {{ $quotation->checkedBy == null ? '................................' : ucwords($quotation->checkedBy->name )}}</p>--}}
                                <br><b>Approved by :</b> {{ $quote->quotation->approvedBy == null ? 'WAITING APPROVAL' : ucwords($quote->quotation->approvedBy->name) }}</p>
                                <p><b>Date :</b> {{ $quote->updated_at->format('d-M-y') }}</p>
                                {{--<h4><b>Signed :</b> ...........................</h4>--}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>

                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-12 pull-right">
                      <button id="print" class="btn btn-success pull-right" type="button"> <span><i class="fa fa-print"></i> Print / Download</span> </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
