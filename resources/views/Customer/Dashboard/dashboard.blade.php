@extends('Customer.Main.main')
@section('content')
    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <!-- Category -->
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu">
                            <h3>Category</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <div class="category-list">
                                            <h5>
                                                <a href="#">{{$category->categoryName}}</a>
                                            </h5>
                                        </div>
                                    </li>
                                    @if($loop->last)
                                        <li class="pb-30">
                                            <div class="category-list">
                                                <h5>
                                                    <a href="#">{{$category->categoryName}}</a>
                                                </h5>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Category -->
                <!-- Product -->
                <div class="col-xxl-9 col-xl-8 mb-5">
                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @foreach($products as $product)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.05s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="#">
                                                @php
                                                $image = json_decode($product->image,true);
                                                @endphp
                                                <img src="ProductImage/{{$image[0]}}"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a id="view" data-url="{{route('getProductDetailsInfo',$product->id)}}"><i data-feather="eye"></i></a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="#">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="#" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">
                                             {{$product->product_category->categoryName}}
                                            </span>
                                            <a href="#">
                                                <h5 class="name">{{$product->productName}}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{$product->details}}</p>
                                        </div>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                @for($i=0; $i<$product->rating;$i++)
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                @endfor
                                            </ul>
                                            <span>{{$product->rating}}.0</span>
                                        </div>
                                        <h5 class="price"><span class="theme-color">{{$product->price}} BDT</span> {{--<del>$15.15</del>--}}
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                            data-type="minus" data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                            data-type="plus" data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Product -->
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <!-- View Product -->
    <div class="modal fade theme-modal view-modal" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="" class="img-fluid blur-up lazyload" id="productImage" alt="productHeadImage" title="Product Title Image">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                                <h4 class="price">$36.99</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                        Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                        Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                        muffin I love carrot cake sugar plum dessert bonbon.</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>Black Forest</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>W0690034</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Type:</h5>
                                            <h6>White Cream Cake</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Cake Size :</h4>
                                    <select class="form-select select-form-size">
                                        <option selected>Select Size</option>
                                        <option value="1.2">1/2 KG</option>
                                        <option value="0">1 KG</option>
                                        <option value="1.5">1/5 KG</option>
                                        <option value="red">Red Roses</option>
                                        <option value="pink">With Pink Roses</option>
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <button onclick="location.href = 'cart.html';"
                                            class="btn btn-md add-cart-button icon">Add
                                        To Cart</button>
                                    <button onclick="location.href = 'product-left.html';"
                                            class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        View More Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Part -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    @endif
    <script>
        $(document).ready(function () {
            $('body').on('click', '#view', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    console.log(data)
                    $('#viewModal').modal('show');
                })
            });
        });
    </script>
@endsection
