@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        
        <div class="container">
            <div class="subtitle h6">
                <div class="d-inline-block">
                    
                </div>
            </div>
            <div class="row">
                @foreach($products as $index => $item)
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-2 col-lg-2 align-self-center">
                                    <figure class="product-image"><img src="{{asset('img/products/images')}}/{{$item->image_source}}" alt="" class=""></figure>
                                </div>
                                <div class="col">
                                    <button class="btn btn-sm btn-link p-0 float-right"><i class="material-icons md-18">favorite_outline</i></button>
                                    @if($item->price->first()->discount_status === 1)
                                    <div class="badge badge-primary float-right mt-1">{{$item->price->first()->discount_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $item->price->first()->price_id,'slug' => $item->price->first()->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                                    <del>{{ $item->price->first()->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->discount_price }}</h5>
                                    @endif
                                    @if($item->price->first()->amazing_status === 1)
                                    <div class="badge badge-danger float-right mt-1">{{$item->price->first()->amazing_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $item->price->first()->price_id,'slug' => $item->price->first()->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                                    <del>{{ $item->price->first()->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->amazing_price }}</h5>
                                    @endif
                                    @if($item->price->first()->discount_status === 0 && $item->price->first()->amazing_status === 0)
                                    <a href="{{route('show_detail_product',['id' => $item->price->first()->price_id,'slug' => $item->price->first()->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                    <h5 class="text-success font-weight-normal mb-0">{{$item->price->first()->price}}</h5>
                                    @endif
                                    <p class="text-discount small text-mute mb-0">گارانتی {{$item->price->first()->warranty_date}}<br>{{$item->price->first()->warranty_name}}</p>
                                </div>
                            </div>
                            <a href="{{route('add_to_cart',['id' => $item->price->first()->price_id,'slug' => $item->price->first()->slug])}}"><button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
        <div class="row mb-3" style="justify-content: center;">
            {{$products->render('mobile-view.partials-main.pagination')}}
        </div>
        @include('mobile-view.blog-view.blog-index')
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
