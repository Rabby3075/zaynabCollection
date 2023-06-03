@extends('Customer.Main.main')
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>OTP</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">OTP</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section otp-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="../assets/images/inner-page/otp.png" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3 class="text-title">Please enter the one time password to verify your account</h3>
                                <h5 class="text-content">A code has been sent to your email</h5>
                            </div>
                            <form action="{{route('otpSubmit')}}" method="post">
                                {{csrf_field()}}
                            <div id="otp" class="inputs d-flex flex-row justify-content-center">
                                <input class="text-center form-control rounded" type="text" name="first" id="first" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" name="second" id="second" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" name="third" id="third" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" name="fourth" id="fourth" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" name="fifth" id="fifth" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" name="sixth" id="sixth" maxlength="1"
                                       placeholder="0">
                            </div>

                            <div class="send-box pt-4">
                                <h5>Didn't get the code? <a href="{{route('ResendOtp')}}" class="theme-color fw-bold">Resend
                                        It</a></h5>
                            </div>
                            <button class="btn btn-animation w-100 mt-3"
                                    type="submit">Validate</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endsection
