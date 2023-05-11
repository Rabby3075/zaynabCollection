
@extends('Admin.Dashboard.Main.main')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Category List</h4>
                <div class="form-group row">
                    <div class="col-md-6">
                        <button class="btn btn-success float-left" id="export-btn"><i
                                class="bi bi-file-earmark-spreadsheet me-2"></i>Excel
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>IP</th>
                            <th>Operating System</th>
                            <th>Browser</th>
                            <th>Device</th>
                            <th>Location</th>
                            <th>Login Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$log->Ip}}</td>
                                <td>{{$log->Os}}</td>
                                <td>{{$log->Browser}}</td>
                                <td>{{$log->Device}}</td>
                                <td>{{$log->Location}}</td>
                                <td>{{$log->LoginTime}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

