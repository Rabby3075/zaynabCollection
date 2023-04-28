<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" type="image/png" href="../image/default/logo.jpg">

    <link rel="stylesheet" href="/css/library/bootstrap.css">
    <link rel="stylesheet" href="{{asset('css/admin/login.css')}}">
</head>
<body>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0"><img  src="../image/default/logo.jpg" alt="logo" width=170 height=120></span>
        </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
        <form style="width: 23rem;" action="{{route('AdminLogin')}}" method="post">
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

            @if(Session::has('message'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <p>{{Session::get('message')}}</p>
                </div>
            @endif
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

            <div class="form-outline mb-4">
              <input type="email" class="form-control form-control-lg" name="email" id="email" value="{{old('email')}}" placeholder="Enter your Email"/>
            </div>

            <div class="form-outline mb-4">
              <input type="password" class="form-control form-control-lg" name="password" id="password" value="{{old('password')}}" placeholder="Enter your Password"/>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
            </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
           <!-- <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p> -->

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="../image/default/shopping.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: contain; object-position: left;">
      </div>
    </div>
  </div>
</section>

</body>
    <script src="{{asset('js/library/bootstrap.js')}}"></script>
    <script src="/js/admin/login.js"></script>
</html>
