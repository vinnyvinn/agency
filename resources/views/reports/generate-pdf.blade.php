<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jobs Reports</h4>

                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-striped tbl-agency" id="customers">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact Person</th>
                                <th>Vessel Name</th>
                                <th>Voyage No</th>
                                <th>Status</th>
                                <th>Created</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->customer ? ucwords($job->customer->Name) :''}}</td>
                                    <td>{{ $job->customer ? ucfirst($job->customer->Contact_Person) :''}}</td>
                                    <td>{{ $job->vessel?$job->vessel->name:'' }}</td>
                                    <td>{{$job->quote?$job->quote->voyage->name :''}}</td>
                                    <td>{{$job->status==0 ? 'Active Job' : 'Completed Job'}}</td>
                                    <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d-M-y') }}</td>
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
<style>

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;

        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

