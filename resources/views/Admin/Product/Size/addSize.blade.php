
@extends('Admin.Dashboard.Main.main')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Size</h4>

                <form class="forms-sample" action="{{route('addSize')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="size">Size Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="size" id="size" placeholder="Ex: XLL, XL, L,...">
                    </div>
                    <div class="form-group">
                        <label for="height">Height <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="height" id="height" step="0.1" placeholder="Enter Height">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" class="form-control" step="0.1" name="weight" id="weight" placeholder="Enter Weight">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

