<!doctype html>
<html lang="en" class="blue-theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="{{$metadescription}}">
    <meta name="author" content="EmdadIT">

     <title>{{$headertitle}}</title>

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
    

    <!-- Content is Here -->
    @yield('body-main-content')
    <!-- Content is Here -->


    <!-- jquery, popper and bootstrap js -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>

    <!-- swiper js -->
    <script src="{{asset('vendor/swiper/js/swiper.min.js')}}"></script>

    <!-- template custom js -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            /* swiper slider carousel */
            var swipersmall = new Swiper('.small-slide', {
                slidesPerView: 'auto',
                spaceBetween: 0,
            });
            var swipernews = new Swiper('.news-slide', {
                slidesPerView: 5,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    },
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                    }
                }
            });
            

            /* notification view and hide */
            setTimeout(function() {
                $('.notification').addClass('active');
                setTimeout(function() {
                    $('.notification').removeClass('active');
                }, 8000);
            }, 500);
            $('.closenotification').on('click', function() {
                $(this).closest('.notification').removeClass('active')
            });
        });

    </script>
    <script>
        var swiper = new Swiper('.swiper-index-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

    </script>
    @yield('script-detail-product-content')
    

</body>

</html>
