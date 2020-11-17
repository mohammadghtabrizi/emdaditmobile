@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
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


            <a href="{{route('add_to_favorites',['id' => $price->id,'slug' => $product->slug])}}"><button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-rounded ml-2" data-toggle="modal" data-target="#share"><i class="material-icons mb-18 mr-2">subscriptions</i> اشتراک با دوستان</a>
            @if($price->amazing_status == 1)
            <div class="badge badge-danger float-right mt-1">{{$price->amazing_percent}}&nbsp;تخفیف</div>
            @endif
            @if($price->discount_status == 1)
            <div class="badge badge-primary float-right mt-1">{{$price->discount_percent}}&nbsp;تخفیف</div>
            @endif
            <p class="text-secondary my-3 small">
                <i class="material-icons text-warning md-18 vm">star </i>
                <span class="text-dark vm ml-2">{{$product->point}}&nbsp;امتیاز</span> <span class="vm">براساس &nbsp; {{$product->point_count}} &nbsp; بررسی</span>
            </p>
            <a class="text-dark mb-1 mt-2 h6 d-block">{{$product->name}}</a>
            <p class="text-secondary small mb-2">{{$product->technical_name}}</p>
            <p class="text-secondary">{{$product->detail}}</p>
            <div class="row mb-4">
                <div class="col">
                    @if($price->amazing_status === 1 OR $price->discount_status === 1)
                    <del>{{$price->price}}  تومان</del>
                    @endif
                    @if($price->amazing_status === 1)
                    <h3 class="text-danger font-weight-normal mb-0">{{$price->amazing_price}}</h3>
                    @endif
                    @if($price->discount_status === 1)
                    <h3 class="text-danger font-weight-normal mb-0">{{$price->discount_price}}</h3>
                    @endif
                    @if($price->amazing_status === 0 && $price->discount_status ===0)
                    <h3 class="text-danger font-weight-normal mb-0">{{$price->price}}</h3>
                    @endif
                    <p class="text-discount text-mute mb-0">گارانتی  {{$price->warranty_date}}  {{$price->warranty_name}}</p>
                </div>
                <div class="col-auto align-self-center">
                <a href="{{route('add_to_cart',['id' => $price->id,'slug' => $product->slug])}}"><button class="btn btn-lg btn-default shadow btn-rounded"> <i class="material-icons md-18">shopping_cart</i> افزودن به سبد خرید </button></a>
                </div>
            </div>
            <!-- detailprooooo -->
            @if($moreprice <> '')
            <div class="row">
                @foreach($moreprice as $item)
                @if($price->id <> $item->id)
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body p-3">
                            <div class="media">
                                <div class="icon align-self-center">
                                    <i class="material-icons h1 mb-0 mr-3">account_balance</i>
                                </div>
                                <div class="col 8 align-self-center" style="text-align:center;">
                                    <p class=" mb-0 ">گارانتی {{$item->warranty_date}} {{$item->warranty_name}}</p>
                                </div>
                                <div class="col 8 align-self-center" style="text-align:center;">
                                    <p class="text-discount mb-0 text-mute">{{$item->price}}</p>
                                </div>
                                <a class="btn btn-outline-primary align-self-center" href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}">
                                    مشاهده
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
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
                                @foreach($property as $index => $item)
                                
                                <div class="tab-pane active" role="tabpanel" id="technical-specification" style="padding:10px;">
                                    <button type="button" class="shadow-sm mr-2 btn btn-link text-light text-dark mb-2"><i class="material-icons">add_box</i>{{$item->name}}</button></a>
                                    @foreach($item->property as $prop)
                                    
                                    <div class="row">
                                        <div class="col-4" style="padding:5px;">
                                            <p class="mb-0 text-black f-sm" style="background-color: #eff4fd;padding: 7px;">{{$prop->name}}</p>
                                        </div>
                                        <div class="col-8" style="padding:5px;">
                                            <p class="mb-0 text-black f-sm" style="background-color: #fdefef;padding: 7px;">{{$prop->value}}</p>
                                        </div>
                                    </div>
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
