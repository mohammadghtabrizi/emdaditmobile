@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <h6 class="subtitle">دسته بندی ها</h6>
            <div class="row">
                @foreach($category as $item)
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body text-center p-4">
                            <img src="{{asset('img/products/categories')}}/{{$item->category_image_source}}" alt="" class="small-slide-right">
                            <h5 class="mb-1" style="padding-top:15px;">{{$item->category_name}}</h5>
                            <br>
                            <a class href="{{route('show_sub_category_product',['id' => $item->category_id,'slug' => $item->category_slug])}}"><button class="btn btn-outline-primary btn-sm">نمایش</button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @foreach($categories as $index => $item)
        <div class="container">
            <div class="subtitle h6">
                <div class="d-inline-block">
                    {{$item->category_name}}
                </div>
            </div>
            <div class="row">
                @foreach($item->products as $index2 => $products)
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-2 col-lg-2 align-self-center">
                                    <figure class="product-image"><img src="{{asset('img/products/images')}}/{{$products->images_image_source}}" alt="" class=""></figure>
                                </div>
                                <div class="col">
                                    <button class="btn btn-sm btn-link p-0 float-right"><i class="material-icons md-18">favorite_outline</i></button>
                                    @if($prices[$products->product_id][$products->product_id]['prices']->discount_status === 1)
                                    <div class="badge badge-primary float-right mt-1">{{$prices[$products->product_id][$products->product_id]['prices']->discount_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $prices[$products->product_id][$products->product_id]['prices']->id,'slug' => $prices[$products->product_id][$products->product_id]['prices']->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$products->name}}</a>
                                    <del>{{ $prices[$products->product_id][$products->product_id]['prices']->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $prices[$products->product_id][$products->product_id]['prices']->discount_price }}</h5>
                                    @endif
                                    @if($prices[$products->product_id][$products->product_id]['prices']->amazing_status === 1)
                                    <div class="badge badge-danger float-right mt-1">{{$prices[$products->product_id][$products->product_id]['prices']->amazing_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $prices[$products->product_id][$products->product_id]['prices']->id,'slug' => $prices[$products->product_id][$products->product_id]['prices']->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$products->name}}</a>
                                    <del>{{ $prices[$products->product_id][$products->product_id]['prices']->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $prices[$products->product_id][$products->product_id]['prices']->amazing_price }}</h5>
                                    @endif
                                    @if($prices[$products->product_id][$products->product_id]['prices']->discount_status === 0 && $prices[$products->product_id][$products->product_id]['prices']->amazing_status === 0)
                                    <a href="{{route('show_detail_product',['id' => $prices[$products->product_id][$products->product_id]['prices']->id,'slug' => $prices[$products->product_id][$products->product_id]['prices']->slug])}}" class="text-dark mb-1 h6 d-block">{{$products->product_name}}</a>
                                    <h5 class="text-success font-weight-normal mb-0">{{$prices[$products->product_id][$products->product_id]['prices']->price}}</h5>
                                    @endif
                                    <p class="text-discount small text-mute mb-0">گارانتی {{$prices[$products->product_id][$products->product_id]['prices']->warranty_date}}<br>{{$prices[$products->product_id][$products->product_id]['prices']->warranty_name}}</p>
                                </div>
                            </div>
                            <a href="{{route('show_detail_product',['id' => $prices[$products->product_id][$products->product_id]['prices']->id,'slug' => $prices[$products->product_id][$products->product_id]['prices']->slug])}}"><button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        @include('mobile-view.blog-view.blog-index')
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
