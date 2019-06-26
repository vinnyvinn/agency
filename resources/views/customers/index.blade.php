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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customers</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Account</th>
                                    <th>Telephone</th>
                                    {{--<th>Created</th>--}}
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ ucwords($customer->Name) }}</td>
                                        <td>{{ ucfirst($customer->Contact_Person) }}</td>
                                        <td>{{ $customer->Account }}</td>
                                        <td>
                                            {{ $customer->Telephone }}
                                        </td>
                                        @can('manage-leads')
                                            <td>
                                                <div class="row">
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg{{$customer->DCLink}}"><i class="fa fa-plus"></i></button>

                                                    <div class="modal fade bs-example-modal-lg{{$customer->DCLink}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Add As Lead</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <form class="form-material m-t-40" action="{{ route('leads.store') }}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="form-group">
                                                                                                <label for="name">Name <span class="help">(Customer or Company Name)</span></label>
                                                                                                <input type="text" value="{{ ucwords($customer->Name) }}" required id="name" name="name" class="form-control" placeholder="Name">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="contact_person">Contact Person</label>
                                                                                                <input type="text" required id="contact_person" value="{{ ucfirst($customer->Contact_Person) }}" name="contact_person" class="form-control" placeholder="Contact Person">
                                                                                            </div>
                                                                                            <input type="hidden" name="client_id" value="{{$customer->DCLink}}">
                                                                                            <div class="form-group">
                                                                                                <label for="email">Email </label>
                                                                                                <input type="email" required id="email" name="email" class="form-control" placeholder="Email">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="phone">Phone </label>
                                                                                                <input type="text" required id="phone" name="phone" class="form-control" placeholder="Phone">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="form-group">
                                                                                                <label for="telephone">Telephone </label>
                                                                                                <input type="text" id="telephone" name="telephone" value="{{ $customer->Telephone }}" class="form-control" placeholder="Telephone">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="cPhysicalAddress1">Address 1</label>
                                                                                                <input type="text" id="cPhysicalAddress1" name="cPhysicalAddress1" class="form-control" placeholder="Address 1">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="cPhysicalAddress2">Address 2</label>
                                                                                                <input type="text" id="cPhysicalAddress2" name="cPhysicalAddress2" class="form-control" placeholder="Address 2">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="currency">Select Currency </label>
                                                                                                <select name="currency" id="currency" class="form-control select2">
                                                                                                    <option value="">Select Currency</option>
                                                                                                    @foreach(json_decode(\Esl\helpers\Constants::CURRENCY_ARRAY) as $value)
                                                                                                        <option value="{{$value->code}}">{{ $value->name_plural }}</option>
                                                                                                    @endforeach
                                                                                                </select>
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
                                            </td>
                                            @endcan
                                    </tr>
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
        var customer = $('#search_customer');

        customer.on('keyup', function () {
           axios.post('{{ url('/search-customer') }}',{
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
