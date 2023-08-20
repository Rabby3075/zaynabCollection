
@extends('Admin.Dashboard.Main.main')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title col-md-6">Size List</h4>
                <div class="form-group row">
                    <div class="col-md-6">
                        <button class="btn btn-success float-left" id="export-btn"><i class="bi bi-file-earmark-spreadsheet me-2"></i>Excel</button>
                    </div>
                    <div class="col-md-6 ml-0">
                        <a href="{{route('sizeView')}}" class="btn btn-success float-right"><i class="bi bi-plus-circle me-2"></i>Add</a>
                    </div>
                </div>
                @if (\Session::has('success'))
                    <div id="toast-container">
                        <div class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="bi bi-check-circle"></i>
                                    <label id="msg"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (\Session::has('failed')||\Session::has('delete'))
                    <div id="toast-container">
                        <div class="toast align-items-center text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="bi bi-exclamation-circle"></i>
                                    <label id="msg"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-responsive-lg table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Size Name</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sizes as $size)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$size->size}}</td>
                                <td>{{$size->height}}</td>
                                <td>{{$size->weight}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" id="edit" title="edit"  data-url="{{route('getSizeInfo',$size->id)}}">
                                        <i class="bi bi-pen"></i>
                                    </a>


                                    <a class="btn btn-danger btn-sm" id="delete" title="Delete"  data-url="{{route('getSizeInfo',$size->id)}}">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Size Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="text-dark">Are you sure to delete this size?</span>
                </div>
                <div class="modal-footer">
                    <form action="{{route('deleteSize')}}" class="form-group" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="size-id" name="id">
                        <input type="submit" class="btn btn-danger" id="yes" value="Yes">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Edit Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{route('updateSize')}}" method="post" enctype="multipart/form-data">
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
                                        <input type="hidden" class="form-control" name="id" id="id"
                                               placeholder="Enter your product name">
                                    </div>
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
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('body').on('click', '#delete', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    $('#deleteModal').modal('show');
                    $('#size-id').val(data.id);

                })
            });
        });

        $(document).ready(function () {
            $('body').on('click', '#edit', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    $('#editModal').modal('show');
                    $('#size').val(data.size);
                    $('#id').val(data.id);
                    $('#height').val(data.height);
                    $('#weight').val(data.weight);
                })
            });
        });

    </script>
    @if (\Session::has('success'))
        <script>
            $(document).ready(function () {
                showToast("{!! \Session::get('success') !!}");
            });
        </script>
    @elseif(\Session::has('failed'))
        <script>
            $(document).ready(function () {
                showToast("{!! \Session::get('failed') !!}");
            });
        </script>
    @elseif(\Session::has('delete'))
        <script>
            $(document).ready(function () {
                showToast("{!! \Session::get('delete') !!}");
            });
        </script>
    @endif
@endsection

