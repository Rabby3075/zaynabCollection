
    @extends('Admin.Dashboard.Main.main')
    @section('content')
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Product Details</h4>
                            <div id="addProductDetails"></div>
                            @vite('resources/js/app.js')
{{--                            <form class="forms-sample" action="{{route('addProductDetails')}}" method="post" enctype="multipart/form-data">--}}
{{--                                {{csrf_field()}}--}}
{{--                                @if ($errors->any())--}}
{{--                                    <div class="alert alert-danger alert-dismissible">--}}
{{--                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>--}}
{{--                                        <ul>--}}
{{--                                            @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Product Name <span class="text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control" name="name" id="name"--}}
{{--                                           placeholder="Enter your product name">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="category">Product Category <span class="text-danger">*</span></label>--}}
{{--                                    <select class="js-example-basic-single w-100" id="category" name="category">--}}
{{--                                        <option value="">Select a product category</option>--}}
{{--                                        @foreach($categories as $category)--}}
{{--                                            <option value="{{$category->id}}">{{$category->categoryName}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="price">Product Color <span class="text-danger">*</span></label>--}}
{{--                                    <input type="number" class="form-control" name="price" id="price"--}}
{{--                                           placeholder="Enter your product price">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="quantity">Product Quantity <span class="text-danger">*</span></label>--}}
{{--                                    <input type="number" class="form-control" name="quantity" id="quantity"--}}
{{--                                           placeholder="Enter your product quantity">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Product Photos <span class="text-danger">*</span></label>--}}
{{--                                    <input type="file" name="image[]" class="file-upload-default" multiple>--}}
{{--                                    <div class="input-group col-xs-12">--}}
{{--                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Images">--}}
{{--                                        <span class="input-group-append">--}}
{{--                                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="details">Caption</label>--}}
{{--                                    <textarea class="form-control" id="details" name="details" rows="4" placeholder="Write details about this product"></textarea>--}}
{{--                                </div>--}}


{{--                                <button type="submit" class="btn btn-primary mr-2">Submit</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
    @endsection

