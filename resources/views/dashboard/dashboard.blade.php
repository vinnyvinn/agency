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
        @can('generate-quotation')
            <div class="row">
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Row -->
                            <div class="row">
                                  <a href="{{ url('/all-pdas') }}" class="btn btn-primary">Quotations</a><br>
                                  <div class="tab-pane  p-20" id="profile" role="tabpanel" style="display: none;">
                                            {{--@if(count($quotation->cargos) < 1)--}}
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lgcargo">Quotation</button>
                                            {{--@endif--}}
                                                <div class="modal fade bs-example-modal-lgcargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Generate Quotation</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <form class="m-t-40" method="post" id="cargo">
                                                                   <div class="form-group">
                                                                        <input type="checkbox" name="temp" class="check template" id="t1" value="save">
                                                             <label for="t1">Save to a template</label>
                                                                   </div>
                                                                   <div class="form-group template_name">
                                                                       <label>Template Name</label>
                                                                       <input type="text" class="form-control" name="template_name" placeholder="Enter Template Name">
                                                                   </div>
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="temp" class="check template" id="t2" value="select">
                                                                <label for="t2">Choose from a template</label>
                                                                   </div>
                                                                   <div class="form-group list_templates">
                                                                    <label>Choose Template</label>
                                                                       <select name="list_templates" name="list_templates" class="form-control" id="list_templates">
                                                                           <option value="1">ewrewrer</option>
                                                                       </select>
                                                                   </div>
                                                                     <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary waves-effect text-left">Proceed</button>
                                                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                  </form>
                                                                          </div>
                                                                            </div>
                                                                          
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                          
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-8"><h2 class="">{{ count(\App\Quotation::where('status', \Esl\helpers\Constants::LEAD_QUOTATION_PENDING)->get()) }} <i class="ti-angle-up font-14 text-success"></i></h2>
                                    <h6>Pending PDA</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-8"><h2 class="">{{ count(\App\Quotation::where('status', \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)->get()) }} <i class="ti-angle-up font-14 text-success"></i></h2>
                                    <h6>Waiting PDA</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-8"><h2 class="">{{ count(\App\BillOfLanding::where('status', 1)->get()) }} <i class="ti-angle-up font-14 text-success"></i></h2>
                                    <h6>FDA</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('manage-leads')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leads</h4>
                            </div>
                            <div class="comment-widgets m-b-20">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact Person</th>
                                                    {{--<th>Phone</th>--}}
                                                    {{--<th>Email</th>--}}
                                                    <th class="text-nowrap">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="customers">
                                                @foreach($leads as $lead)
                                                    @if($lead->status == 0)
                                                        <tr>
                                                            <td>{{ ucwords($lead->name) }}</td>
                                                            <td>{{ ucfirst($lead->contact_person) }}</td>
                                                            {{--<td>{{ $lead->phone }}</td>--}}
                                                            {{--<td>{{ $lead->email }}</td>--}}
                                                            <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-M-y') }}</td>
                                                            <td class="text-nowrap">
                                                                <a href=" {{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="footable pagination">
                                                {{ $leads->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-lg-4">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card-body">--}}
                                {{--<h4 class="card-title">Notification</h4>--}}
                                {{--<ul class="feeds">--}}
                                    {{--@foreach($v_notifications as $notification)--}}
                                        {{--<li>--}}
                                            {{--<div class="bg-light-info"><i class="fa fa-bell-o"></i></div> {{mb_strimwidth($notification->title,0,28)}}.--}}
                                            {{--<a href="{{ url('/notifications/'.$notification->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> <span class="text-muted"> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            @endcan
    </div>
@endsection

@section('scripts')

<script>
    $(function(){
         $('.template_name').hide();
         $('.list_templates').hide();
        $('.template').on('change',function(){
            //console.log($(this). prop("checked"))
            if ($(this).prop("checked") && $(this).val() =='save') {
            $('.template_name').show()
            $('.list_templates').hide()
            }
            else if ($(this).prop("checked") && $(this).val() =='select') {
             $('.list_templates').show()
             $('.template_name').hide()
            }
            
            else{
             $('.list_templates').hide()
             $('.template_name').hide()
            }
           
        })
    })

    $('#cargo').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:'save-template',
            method:'GET',
            type:'JSON',
            data:{data:$('#cargo').serialize()},
            success:function(res){
                console.log(res);
            }
        })
    })
</script>

@endsection