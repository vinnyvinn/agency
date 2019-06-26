    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pdas Reports</h4>
                          </div>
                    <div class="card-body">



                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency" id="customers">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Vessel Name</th>
                                    <th>Status</th>
                                    <th>Created</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pdas as $pda)
                                    <tr>
                                        <td>{{ ucfirst($pda->lead->name) }}</td>
                                        <td>{{ ucfirst($pda->lead->contact_person) }}</td>
                                        <td>{{ $pda->lead->email }}</td>
                                        <td>{{$pda->vessel->name}}</td>
                                        <td>{{ucfirst($pda->status)}}</td>
                                        <td>{{ \Carbon\Carbon::parse($pda->created_at)->format('d-M-y') }}</td>
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

