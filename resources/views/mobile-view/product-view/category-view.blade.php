@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <h6 class="subtitle">دسته بندی ها</h6>
            <div class="row">
                @foreach($showcategoryproduct as $showcategoryproductitem)
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body text-center p-4">
                            <img src="{{asset('img/products/categories')}}/{{ $showcategoryproductitem->image_source }}" alt="" class="small-slide-right">
                            <h5 class="mb-1" style="padding-top:15px;">{{$showcategoryproductitem->category_name}}</h5>
                            <br>
                            <a class href=""><button class="btn btn-outline-primary btn-sm">نمایش</button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
        <div class="subtitle h6">
                <div class="d-inline-block">
                    همه میوه های تازه<br>
                    <p class="small text-mute">2154 محصول</p>
                </div>
                <div class="float-right">
                    <div class="btn-group filter-group" role="group" aria-label="مثال اساسی">
                        <a href="all-products.html" class="btn btn-light "><i class="material-icons">view_module </i></a>
                        <a href="all-products-list.html" class="btn btn-light active"><i class="material-icons">view_list</i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($showcategoryproducts as $index => $item)
                
                {{dd($item->price)}}
                
                @endforeach
                @foreach($showcategoryproducts as $index => $item)
                
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-2 col-lg-2 align-self-center">
                                    <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                                </div>
                                <div class="col">
                                    <button class="btn btn-sm btn-link p-0 float-right"><i class="material-icons md-18">favorite_outline</i></button>
                                    <a href="product-details.html" class="text-dark mb-1 h6 d-block">مبل خاکستری</a>
                                    <p class="text-secondary small mb-2">از سیملا وارد شده است</p>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان 
                                        <span class="badge badge-success d-inline-block ml-2"><small>10٪ تخفیف</small></span>
                                    </h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم</p>
                                </div>
                            </div>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @include('mobile-view.blog-view.blog-index')
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
