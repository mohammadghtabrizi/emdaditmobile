@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <nav aria-label="خرده نان">
                <ol class="breadcrumb bg-primary">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-white">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">کتابخانه</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">داده ها</li>
                </ol>
            </nav>
            <!-- Swiper -->
            <div class="swiper-container product-details">
                <div class="swiper-wrapper">
                    
                    @foreach($image as $item)
                    <div class="swiper-slide">
                        <img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="">
                    </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>


            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-rounded ml-2" data-toggle="modal" data-target="#share"><i class="material-icons mb-18 mr-2">subscriptions</i> اشتراک با دوستان</a>
            @php
                $prices = $price->first();
                $products = $product->first();
            @endphp
            @if($prices->amazing_status == 1)
            <div class="badge badge-danger float-right mt-1">{{$prices->amazing_percent}}&nbsp;تخفیف</div>
            @endif
            @if($prices->discount_status == 1)
            <div class="badge badge-primary float-right mt-1">{{$prices->discount_percent}}&nbsp;تخفیف</div>
            @endif
            <p class="text-secondary my-3 small">
                <i class="material-icons text-warning md-18 vm">star </i>
                <span class="text-dark vm ml-2">{{$products->point}}&nbsp;امتیاز</span> <span class="vm">براساس &nbsp; {{$products->point_count}} &nbsp; بررسی</span>
            </p>
            <a href="#" class="text-dark mb-1 mt-2 h6 d-block">{{$products->name}}</a>
            <p class="text-secondary small mb-2">{{$products->technical_name}}</p>
            <p class="text-secondary">{{$products->detail}}</p>
            <div class="row mb-4">
                <div class="col">
                    @if($prices->amazing_status === 1 OR $prices->discount_status === 1)
                    <del>{{$prices->price}}  تومان</del>
                    @endif
                    @if($prices->amazing_status === 1)
                    <h3 class="text-danger font-weight-normal mb-0">{{$prices->amazing_price}}</h3>
                    @endif
                    @if($prices->discount_status === 1)
                    <h3 class="text-danger font-weight-normal mb-0">{{$prices->discount_price}}</h3>
                    @endif
                    <p class="text-discount text-mute mb-0">گارانتی  {{$prices->warranty_date}}  {{$prices->warranty_name}}</p>
                </div>
                <div class="col-auto align-self-center">
                    <button class="btn btn-lg btn-default shadow btn-rounded"> <i class="material-icons md-18">shopping_cart</i> افزودن به سبد خرید </button>
                </div>
            </div>
            <!-- detailprooooo -->
            @if($prices->amazing_status === 0 AND $prices->discount_status === 0)
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body p-3">
                            <div class="media">
                                <div class="icon align-self-center">
                                    <i class="material-icons h1 mb-0 mr-3">account_balance</i>
                                </div>
                                <div class="col 8 align-self-center" style="text-align:center;">
                                    <p class="text-discount mb-0 text-mute">Document.pdf</p>
                                </div>
                                <button class="btn btn-outline-primary align-self-center">
                                    مشاهده
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-3 wizard">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs tabs-md nav-justified" role="tablist">
                                <li role="presentation" class="nav-item">
                                    <a href="#technical-specification" class="nav-link border-primary active" data-toggle="tab" aria-controls="technical-specification" role="tab" > مشخصات فنی</a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="#step23" class="nav-link border-primary" data-toggle="tab" aria-controls="step23" role="tab" >نظرات کاربران</a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="#step33" class="nav-link border-primary" data-toggle="tab" aria-controls="step33" role="tab">پرسش و پاسخ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach($propertykeyparents as $propertykeyparent)
                                
                                <div class="tab-pane active" role="tabpanel" id="technical-specification" style="padding:10px;">
                                    <button type="button" class="shadow-sm mr-2 btn btn-link text-light text-dark mb-2"><i class="material-icons">add_box</i>{{$propertykeyparent->name}}</button>
                                    @foreach($property as $item)
                                    @if($item->key_parent === $propertykeyparent->id)
                                    <div class="row">
                                        <div class="col-4" style="padding:5px;">
                                            <p class="mb-0 text-black f-sm" style="background-color: #eff4fd;padding: 7px;">{{$item->name}}</p>
                                        </div>
                                        <div class="col-8" style="padding:5px;">
                                            <p class="mb-0 text-black f-sm" style="background-color: #fdefef;padding: 7px;">{{$item->value}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @include('mobile-view.blog-view.blog-index')
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
@stop
    @section('script-detail-product-content')
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.product-details ', {
                slidesPerView: 1,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination'
                }
            });


        });

    </script>
    @stop
