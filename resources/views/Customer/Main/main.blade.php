<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zaynab Collection">
    <meta name="keywords" content="Zaynab Collection">
    <meta name="author" content="Sharmin">
    @isset($companyData->logo)
    <link rel="icon" href="/Company/{{ $companyData->logo }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" type="image/png" href="image/default/logo.jpg">
    @endisset
    @isset($companyData->companyName)
        <title>{{$companyData->companyName}}</title>
    @else
        <title>Shop</title>
    @endisset


    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">
    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- Boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

<!-- Loader Start -->
<div class="fullpage-loader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<!-- Loader End -->

<!-- Header Start -->
@include('Customer.Main.navbar')
<!-- Header End -->

<!-- mobile fix menu start -->
<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="index.html">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="mobile-category">
            <a href="javascript:void(0)">
                <i class="iconly-Category icli js-link"></i>
                <span>Category</span>
            </a>
        </li>

        <li>
            <a href="search.html" class="search-box">
                <i class="iconly-Search icli"></i>
                <span>Search</span>
            </a>
        </li>

        <li>
            <a href="wishlist.html" class="notifi-wishlist">
                <i class="iconly-Heart icli"></i>
                <span>My Wish</span>
            </a>
        </li>

        <li>
            <a href="cart.html">
                <i class="iconly-Bag-2 icli fly-cate"></i>
                <span>Cart</span>
            </a>
        </li>
    </ul>
</div>
<!-- mobile fix menu end -->
@yield('content')
<!-- Breadcrumb Section Start -->

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<!--Footer-->
{{--@include('Customer.Main.footer')--}}

<!-- latest jquery-->
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/feather/feather.min.js"></script>
<script src="../assets/js/feather/feather-icon.js"></script>

<!-- Slick js-->
<script src="../assets/js/slick/slick.js"></script>
<script src="../assets/js/slick/slick-animation.min.js"></script>
<script src="../assets/js/slick/custom_slick.js"></script>

<!-- Lazyload Js -->
<script src="../assets/js/lazysizes.min.js"></script>

<!-- script js -->
<script src="../assets/js/script.js"></script>
</body>

</html>
