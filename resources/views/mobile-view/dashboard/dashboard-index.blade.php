@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <div class="text-center">
                <div class="figure-profile shadow my-4">
                    <figure><img src="{{asset('img/dashboard/users/profile')}}/{{Auth::user()->userpicture}}" alt=""></figure>
                </div>
                <h3 class="mb-1 ">{{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
                <p class="text-secondary">امتیاز شما {{Auth::user()->points}}</p>
            </div>
            <br>
            @if(Auth::user()->wallet_status === 1)
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <span class="btn btn-default p-3 btn-rounded-15">
                                <i class="material-icons">account_balance_wallet</i>
                            </span>
                        </div>
                        <div class="col pl-0">
                            <p class="text-secondary mb-1">موجودی </p>
                            <h4 class="text-dark my-0">{{Auth::user()->wallet}} &#8203;&#8203;تومان</h4>
                        </div>
                        <div class="col-auto pl-0 align-self-center">
                            <button class="btn btn-default button-rounded-36 shadow"><i class="material-icons">add</i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link text-left active" id="nav-cart-tab" data-toggle="tab" href="#nav-cart" role="tab" aria-controls="nav-cart" aria-selected="true">
                        <div class="row">
                            <div class="col-auto align-self-center pr-1">
                                <span class="btn btn-success button-rounded-26">
                                    <i class="material-icons md-18 text-mute">local_mall</i>
                                </span>
                            </div>
                            <div class="col-auto align-self-center pr-1">
                                <h6 class="text-dark my-0">آخرین سفارشات</h6>
                            </div>
                        </div>
                    </a>
                    <a class="nav-item nav-link text-left" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false">
                        <div class="row">
                            <div class="col-auto align-self-center pr-1">
                                <span class="btn btn-warning button-rounded-26">
                                    <i class="material-icons md-18 text-mute">payment</i>
                                </span>
                            </div>
                            <div class="col-auto align-self-center pr-1">
                                <h6 class="text-dark my-0">آخرین پرداخت ها</h6>
                            </div>
                        </div>
                    </a>
                    <a class="nav-item nav-link text-left" id="nav-request-tab" data-toggle="tab" href="#nav-request" role="tab" aria-controls="nav-request" aria-selected="false">
                        <div class="row">
                            <div class="col-auto align-self-center pr-1">
                                <span class="btn btn-primary button-rounded-26">
                                    <i class="material-icons md-18 text-mute">build</i>
                                </span>
                            </div>
                            <div class="col-auto align-self-center pr-1">
                                <h6 class="text-dark my-0">آخرین درخواست ها</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-cart" role="tabpanel" aria-labelledby="nav-cart-tab">
                    <ul class="list-items">
                        <li style="background-color: bisque;">
                            <div class="row">
                                <div class="col align-self-center pr-1">شماره سفارش</div>
                                <div class="col align-self-center pr-1">تاریخ ثبت سفارش</div>
                                <div class="col align-self-center pr-1">مبلغ پرداخت شده</div>
                                <div class="col align-self-center pr-1">وضعیت</div>
                            </div>
                        </li>
                    
                    @foreach($orders as $item)
                        <li>
                            <div class="row">
                                <div class="col align-self-center pr-1">{{$item->po_order_id}}</div>
                                <div class="col align-self-center pr-1">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($item->CREATED_AT))}}</div>
                                <div class="col align-self-center pr-1">{{$item->po_price_purchased}}</div>
                                <div class="col align-self-center pr-1">
                                    @if($item->po_status === 0)
                                    <a href="{{route('show_my_orders',['id' => $item->po_id,'slug' => $item->po_order_id])}}">
                                        <button type="button" class="mb-2 btn {{ $orderstatuses[$item->po_status]['color'] }}">{{ $orderstatuses[$item->po_status]['title'] }}</button>
                                    </a>
                                    @endif
                                    @if($item->po_status === 1)
                                    <a href="{{route('show_my_orders',['id' => $item->po_id,'slug' => $item->po_order_id])}}">
                                        <button type="button" class="mb-2 btn {{ $orderstatuses[$item->po_status]['color'] }}">{{ $orderstatuses[$item->po_status]['title'] }}</button>
                                    </a>
                                    @endif
                                    @if($item->po_status === 2)
                                    <a href="{{route('show_my_orders',['id' => $item->po_id,'slug' => $item->po_order_id])}}">
                                        <button type="button" class="mb-2 btn {{ $orderstatuses[$item->po_status]['color'] }}">{{ $orderstatuses[$item->po_status]['title'] }}</button>
                                    </a>
                                    @endif
                                    @if($item->po_status === 3)
                                    <a href="{{route('show_my_orders',['id' => $item->po_id,'slug' => $item->po_order_id])}}">
                                        <button type="button" class="mb-2 btn {{ $orderstatuses[$item->po_status]['color'] }}">{{ $orderstatuses[$item->po_status]['title'] }}</button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-peyment-tab">
                    <ul class="list-items">
                    @foreach($transaction as $item)
                        <li>
                            <div class="row">
                                <div class="col align-self-center pr-1">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($item->CREATED_AT))}}</div>
                                <div class="col align-self-center pr-1">{{$item->price}}</div>
                                <div class="col align-self-center pr-1"><a href="#"><button type="button" class="mb-2 btn btn-outline-primary">نمایش</button></a></div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="nav-request" role="tabpanel" aria-labelledby="nav-request-tab">
                    <ul class="list-items">
                    @foreach($merequest as $item)
                        <li>
                            <div class="row">
                                
                                <div class="col align-self-center pr-1">{{$services[$item->typerequest]}}</div>
                                <div class="col align-self-center pr-1">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($item->created_at))}}</div>
                                <div class="col align-self-center pr-1"><a href="#"><button type="button" class="mb-2 btn {{ $statuses[$item->status]['color'] }}">{{ $statuses[$item->status]['title'] }}</button></a></div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>

            <h6 class="subtitle">اطلاعات تماس</h6>
            <dl class="row mb-4">
                <dt class="col-3 text-secondary font-weight-normal">ایمیل</dt>
                <dd class="col-9">{{Auth::user()->email}}</dd>
                <dt class="col-3 text-secondary font-weight-normal">تلفن</dt>
                <dd class="col-9">{{Auth::user()->phone}}</dd>
                <dt class="col-3 text-secondary font-weight-normal">همراه</dt>
                <dd class="col-9">{{Auth::user()->mobile}}</dd>
            </dl>

            <h6 class="subtitle">نشانی و کد پستی</h6>
            <p class="mb-4">{{Auth::user()->address1}}</p>
            <p class="mb-4">{{Auth::user()->postalcode}}</p>
            <p class="mb-4">{{Auth::user()->address2}}</p>
            
            <a href="profile-edit.html" class="btn btn-lg btn-dark text-white btn-block btn-rounded shadow"><span>ویرایش نمایه </span><i class="material-icons">arrow_back</i></a>
            <br>
        </div>
        
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
