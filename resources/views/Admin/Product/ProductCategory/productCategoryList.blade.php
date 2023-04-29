@if(Session::get('email'))
    @extends('Admin.Dashboard.Main.main')
    @section('content')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>

        <!-- JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Category List</h4>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button class="btn btn-success float-left" id="export-btn"><i class="bi bi-file-earmark-spreadsheet me-2"></i>Excel</button>
                                </div>
                                <div class="col-md-6 ml-0">
                                    <a href="{{route('addProductDetailsView')}}" class="btn btn-success float-right"><i class="bi bi-plus-circle me-2"></i>Add</a>
                                </div>
                            </div>
                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                                        <p>{!! \Session::get('success') !!}</p>

                                </div>
                            @endif
                            @if (\Session::has('failed'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                                        <p>{!! \Session::get('failed') !!}</p>


                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$category->categoryName}}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm" id="edit" title="edit"  data-url="{{route('getProductCategoryInfo',$category->id)}}">
                                                <i class="bi bi-pen"></i>
                                            </a>

                                            <a class="btn btn-danger btn-sm" id="delete" title="Delete"  data-url="{{route('getProductCategoryInfo',$category->id)}}">
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
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Product Category Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="text-dark">Are you sure to delete this product category?</span>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('deleteProductCategory')}}" class="form-group" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" id="product-id" name="id">
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
                        <h5 class="modal-title text-success">Edit Product Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{route('editProductCategory')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="name">Category Name <span class="text-danger">*</span></label>
                                            <input type="hidden" class="form-control" name="id" id="id" placeholder="Enter your category name">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your category name">
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
                        $('#product-id').val(data.id);

                    })
                });
            });
            $(document).ready(function () {
                $('body').on('click', '#edit', function () {
                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {
                        $('#editModal').modal('show');
                        $('#name').val(data.categoryName);
                        $('#id').val(data.id);
                    })
                });
            });
        </script>

    @endsection
@endif
