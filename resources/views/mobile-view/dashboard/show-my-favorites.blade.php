@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        
        <div class="container">
            <div class="subtitle h6">
                <div class="d-inline-block">
                    لیست محصولات مورد علاقه شما
                </div>
            </div>
            <div class="row">
                @foreach($products as $item)
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 col-md-2 col-lg-2 align-self-center">
                                    <figure class="product-image"><img src="{{asset('img/products/images')}}/{{$item->image_source}}" alt="" class=""></figure>
                                </div>
                                <div class="col">
                                    @if($item->inventory === 0)
                                    <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                                    <p class="text-discount small text-mute mb-0">این محصول با گارانتی و قیمت متفاوت موجود می باشد</p>
                                    @endif
                                    @if($item->inventory > 0)
                                    @if($item->discount_status === 1)
                                    <div class="badge badge-primary float-right mt-1">{{$item->discount_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                                    <del>{{ $item->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $item->discount_price }}</h5>
                                    @endif
                                    @if($item->amazing_status === 1)
                                    <div class="badge badge-danger float-right mt-1">{{$item->amazing_percent}}&nbsp;تخفیف</div>
                                    <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                                    <del>{{ $item->price }}</del>
                                    <h5 class="text-success font-weight-normal mb-0">{{ $item->amazing_price }}</h5>
                                    @endif
                                    @if($item->discount_status === 0 && $item->amazing_status === 0)
                                    <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                    <h5 class="text-success font-weight-normal mb-0">{{$item->price}}</h5>
                                    @endif
                                    <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}}</p>
                                    @endif
                                </div>
                            </div>
                            <a href="{{route('delete_my_favorite',['id' => $item->id,'slug' => $item->slug])}}"><button class="btn btn-danger shadow-sm float-bottom-right">حذف</button></a>
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
