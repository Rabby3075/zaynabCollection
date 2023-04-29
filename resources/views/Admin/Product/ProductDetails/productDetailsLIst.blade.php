@if(Session::get('email'))
    @extends('Admin.Dashboard.Main.main')
    @section('content')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title col-md-6">Product List</h4>
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
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$product->productName}}</td>
                                            <td>
                                                @foreach($categories as $category)
                                                    @if($product->category === $category->id)
                                                        {{$category->categoryName}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>
                                                @if($product->status === 1)
                                                    <picture class="badge rounded-pill badge-success p-2">Active</picture>
                                                @elseif($product->status === 0)
                                                    <p class="badge rounded-pill badge-danger p-2">Inactive</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" id="edit" title="edit"  data-url="{{route('getProductDetailsInfo',$product->id)}}">
                                                    <i class="bi bi-pen"></i>
                                                </a>

                                                <a class="btn btn-warning btn-sm" id="show" title="show"  data-url="{{route('getProductDetailsInfo',$product->id)}}">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a class="btn btn-danger btn-sm" id="delete" title="Delete"  data-url="{{route('getProductDetailsInfo',$product->id)}}">
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
                        <h5 class="modal-title text-danger">Product Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="text-dark">Are you sure to delete this product?</span>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('productDelete')}}" class="form-group" method="post" enctype="multipart/form-data">
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
                        <h5 class="modal-title text-success">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{route('editProduct')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   placeholder="Enter your product name">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Product Category <span class="text-danger">*</span></label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="">Select a product category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Product Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="price" id="price"
                                                   placeholder="Enter your product price">
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Product Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity" id="quantity"
                                                   placeholder="Enter your product quantity">
                                        </div>
                                        <div class="form-group">
                                            <label for="details">Caption</label>
                                            <textarea class="form-control" id="details" name="details" rows="4" placeholder="Write details about this product"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Product Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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

        <!-- Show Modal-->
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="" class="d-block w-100" id="headImage" alt="...">
                                </div>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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

          /*  $(document).ready(function () {
                $('body').on('click', '#show', function () {
                    $("#headImage").attr("src", "");
                    var itemsToRemove = $('.carousel-item.active').nextAll('div');
                    itemsToRemove.remove();
                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {
                        $('#showModal').modal('show');
                        var images = JSON.parse(data.image);
                       // console.log(images)
                        //console.log(images[0])
                        var imageSrc = "/ProductImage/" + images[0];
                        $("#headImage").attr("src", imageSrc);


                        for (var i = 1; i < images.length; i++){
                            var imagesource = "/ProductImage/" + images[i];
                            //console.log(imagesource)
                            var item = $('<div>').addClass('carousel-item').append($('<img>').addClass('d-block w-100').attr('src', imagesource));
                            $('.carousel-item.active').after(item);
                        }
                    })
                });
            });*/

            function clearCarousel() {
                // remove all carousel items except the first one
                $('.carousel-item').not(':first').remove();
                // set the first carousel item as active
                $('.carousel-item:first').addClass('active');
            }
            $(document).ready(function () {
                $('body').on('click', '#show', function () {
                    $("#headImage").attr("src", "");
                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {
                        $('#showModal').modal('show');
                        var images = JSON.parse(data.image);
                        var imageSrc = "/ProductImage/" + images[0];
                        $("#headImage").attr("src", imageSrc);

                        // clear the carousel items
                        clearCarousel();

                        for (var i = 1; i < images.length; i++){
                            var imagesource = "/ProductImage/" + images[i];
                            var item = $('<div>').addClass('carousel-item').append($('<img>').addClass('d-block w-100').attr('src', imagesource));
                            $('.carousel-item.active').after(item);
                        }
                    })
                });
            });
            $(document).ready(function () {
                $('body').on('click', '#edit', function () {
                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {
                        $('#editModal').modal('show');
                        $('#name').val(data.productName);
                        $('#id').val(data.id);
                        $('#price').val(data.price);
                        $('#quantity').val(data.quantity);
                        $('#details').val(data.details);
                        $('#category').val(data.category);
                        $('#status').val(data.status);
                    })
                });
            });
        </script>
    @endsection
@endif
