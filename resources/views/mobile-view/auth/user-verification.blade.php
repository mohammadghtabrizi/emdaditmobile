<!doctype html>
<html lang="en" class="blue-theme">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

   <title>فروشگاه</title>

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{asset('vendor/materializeicon/material-icons.css')}}">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="{{asset('vendor/swiper/css/swiper.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>   
    <div class="row no-gutters vh-100 loader-screen">
        <div class="col align-self-center text-white text-center">
            <img src="{{asset('img/emdaditlogo.png')}}" alt="لوگو">
            <h1><span class="font-weight-light">امداد</span> آی تی</h1>
            <div class="laoderhorizontal">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="row no-gutters vh-100 proh bg-template">
        <img src="{{asset('img/image-4.png')}}" alt="خدمات امداد آی تی" class="apple right-image align-self-center">
        <div class="col align-self-center px-3 text-center">
        
            
            <form class="form-signin shadow" method="POST" action="{{route('login_front_end_user')}}">
            @csrf
            <img src="{{asset('img/emdaditlogo.png')}}" alt="لوگو امداد آی تی" class="logo-small">
            <h5 class="text-dark " style="padding:20px;"> EmdadIT</h5>
            <h5 class="text-dark" style="text-align:right;"> کد تاییدیه ارسال شده را وارد نمایید</h5>
            <p class="text-dark " style="text-align:right;"> کد تایید به شماره {{$mobile}} ارسال شده است .</p>
                <div class="form-group float-label">
                    <input id="inputEmail" class="form-control" type="mobile" name="mobile" required="" autofocus="">
                    <label for="inputEmail" class="form-control-label">کد تایید</label>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-lg btn-default btn-rounded shadow"><span>تایید </span><i class="material-icons">arrow_back</i></button>
                    </div>
                </div>
            </form>
            <p class="text-center text-white">
                کلیه حقوق مادی و معنوی این وب سایت برای  
                <a href="signup.html" class="text-danger">EmdadIT CO</a> محفوض است .
            </p>
        </div>
    </div>

    <!-- jquery, popper and bootstrap js -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>

    <!-- swiper js -->
    <script src="{{asset('vendor/swiper/js/swiper.min.js')}}"></script>

    <!-- template custom js -->
    <script src="{{asset('js/main.js')}}"></script>


</body>

</html>