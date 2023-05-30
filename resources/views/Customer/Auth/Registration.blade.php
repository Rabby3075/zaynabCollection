@extends('Customer.Main.main')
@section('content')
    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .toast .progress-bar {
            animation: progress 5s linear;
        }

        @keyframes progress {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }
    </style>
    @if (\Session::has('failed'))
        <div id="toast-container">
            <div class="toast align-items-center text-white bg-danger" role="alert"
                 aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-exclamation-circle"></i>
                        <label id="msg"></label>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Sign Up</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign Up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="../assets/images/inner-page/sign-up.png" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Welcome</h3>
                            <h4>Create New Account</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" action="{{route('registration')}}" method="post">
                                {{csrf_field()}}
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                                        <label for="name">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Mobile Number">
                                        <label for="phone">Mobile Number</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                        <label for="name">Address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                            {{---    <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox"
                                                   id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                                <span>Terms</span> and <span>Privacy</span></label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <button class="btn btn-animation w-100" type="submit">Sign Up</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                        <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin"
                                       class="btn google-button w-100">
                                        <img src="../assets/images/inner-page/google.png" class="blur-up lazyload"
                                             alt="">
                                        Sign up with Google
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/" class="btn google-button w-100">
                                        <img src="../assets/images/inner-page/facebook.png" class="blur-up lazyload"
                                             alt=""> Sign up with Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="other-log-in">
                            <h6></h6>
                        </div>
                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{route('loginView')}}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            showToast("{!! \Session::get('failed') !!}");
        });
        function showToast(msg) {
            $('.toast').toast('show');
            $('#msg').text(msg);
            var toastElement = $('.toast:last');
            var toastInterval = setInterval(function() {
                var progressBar = toastElement.find('.toast-progress-bar');
                var currentTime = parseFloat(progressBar.attr('aria-valuenow'));
                var maxTime = parseFloat(progressBar.attr('aria-valuemax'));
                var percentage = Math.round((currentTime / maxTime) * 100);
                if (currentTime >= maxTime) {
                    clearInterval(toastInterval);
                    $('.toast').remove();
                } else {
                    currentTime += 0.1; // Change the timer speed here
                    progressBar.css('width', percentage + '%');
                    progressBar.attr('aria-valuenow', currentTime.toFixed(1));
                }
            }, 100);
        }
    </script>
@endsection
