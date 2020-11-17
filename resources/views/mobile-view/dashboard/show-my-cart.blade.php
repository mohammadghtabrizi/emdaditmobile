@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <div class="subtitle h6">
                <div class="d-inline-block">
                    سبد خرید من<br>
                    <p class="small text-mute">{{$carts->count()}}مورد</p>
                </div>
            </div>
            <div class="row">
                <form class="input-group form-group" method="post" action="{{route('submit_my_order')}}">
                    <div class="col-12 px-0">
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($carts as $item)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <a href="{{route('delete_product_cart',['id' => $item->id , 'slug' => $item->slug])}}"><button class="btn btn-sm btn-link p-0 float-right"><i class="material-icons">remove_circle</i></button></a>
                                    </div>
                                    <div class="col-2 pl-0 align-self-center">
                                        <figure class="product-image h-auto"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="{{( $item->name )}}" class="vm"></figure>
                                    </div>
                                    <div class="col px-0">
                                        @if($item->inventory === 0)
                                        <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                        <h6 class="text-discount text-mute mb-0">این محصول با گارانتی و قیمت مورد نظر شما به اتمام رسیده است و از سبد خرید شما حذف خواهد شد</h6>
                                        @endif
                                        @if($item->inventory > 0)
                                        @if($item->discount_status === 1)
                                        <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                        <del>{{ $item->price }}</del>
                                        <h5 class="text-success font-weight-normal mb-0">{{ $item->discount_price }}</h5>
                                        <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}} <span class=" text-primary ml-2">{{$item->discount_percent}}&nbsp;تخفیف</span></p>
                                        @endif
                                        @if($item->amazing_status === 1)
                                        <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                        <del>{{ $item->price }}</del>
                                        <h5 class="text-success font-weight-normal mb-0">{{ $item->amazing_price }}</h5>
                                        <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}} <span class=" text-danger ml-2">{{$item->amazing_percent}}&nbsp;تخفیف</span></p>
                                        @endif
                                        @if($item->discount_status === 0 && $item->amazing_status === 0)
                                        <a href="{{route('show_detail_product',['id' => $item->id,'slug' => $item->slug])}}" class="text-dark mb-1 h6 d-block">{{$item->name}}</a>
                                        <h5 class="text-success font-weight-normal mb-0">{{ $item->price }}</h5>
                                        <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}} </p>
                                        @endif
                                        @endif
                                    </div>
                                    @if($item->inventory > 0)
                                    <div class="col-auto align-self-center">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                            </div>
                                            <input type="text" class="form-control w-35" placeholder="" value="1">
                                            <div class="input-group-append">
                                                <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form class="form-group" action="{{route('add_discount_product')}}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-auto">
                                <span class="btn btn-success p-3 rounded-circle">
                                    <i class="material-icons">local_activity</i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="form-group mb-0 float-label active">
                                    <input type="text" class="form-control" name="discount" value="{{$discount}}">
                                    <label class="form-control-label">کد تخفیف را اعمال کنید</label>
                                    @error('discount')
                                    <div class="help-text text-danger" style="text-align:right;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-auto align-self-center">
                                <button class="btn btn-default button-rounded-36 shadow" type="submit"><i class="material-icons">arrow_back</i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body border-top-dashed">
                    <div class="row ">
                        <div class="col-4">
                            <p class="text-secondary mb-1 small">مبلغ کل</p>
                            <h5 class="mb-0">{{$totalamount}} ریال</h5>
                        </div>
                        <div class="col-4 text-center">
                            <p class="text-secondary mb-1 small">هزینه حمل</p>
                            <h5 class="mb-0">{{$shippingcost}} ریال</h5>
                        </div>
                        <div class="col-4 text-right">
                            <p class="text-secondary mb-1 small">تخفیف</p>
                            <h5 class="mb-0"> {{$discountprice}} ریال</h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mb-4 border-0 shadow-sm border-top-dashed">
                <div class="card-body text-center">
                    <p class="text-secondary my-1">مبلغ قابل پرداخت</p>
                    <h3 class="mb-0">{{$amountpayable}} ریال</h3>
                    <br>
                    <a href="checkout.html" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span></span><span>ثبت سفارش و ادامه </span><i class="material-icons">arrow_back</i></a>
                </div>
            </div>



        </div>
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
