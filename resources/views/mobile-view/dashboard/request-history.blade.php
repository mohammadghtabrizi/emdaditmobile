@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <h6 class="subtitle">تاریخچه درخواست ها</h6>
            <div class="row">
                <div class="swiper-container small-slide">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <a href="{{route('request_history_users',['status' => '0'])}}" class="text-dark mb-1 mt-2 h6 d-block">
                                        <figure class="product-image"><img src="{{asset('img')}}/{{( $statuses[0]['image'])}}" alt="" ></figure>
                                    درحال بررسی <p class="text-danger pad-top">({{$countstatus0}})</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <a href="{{route('request_history_users',['status' => '1'])}}" class="text-dark mb-1 mt-2 h6 d-block">
                                        <figure class="product-image"><img src="{{asset('img')}}/{{( $statuses[1]['image'])}}" alt="" ></figure>
                                        درحال ارسال کارشناس <p class="text-danger pad-top">({{$countstatus1}})</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <a href="{{route('request_history_users',['status' => '2'])}}" class="text-dark mb-1 mt-2 h6 d-block">    
                                        <figure class="product-image"><img src="{{asset('img')}}/{{( $statuses[2]['image'])}}" alt="" ></figure>
                                        تکمیل شده <p class="text-danger pad-top">({{$countstatus2}})</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <a href="{{route('request_history_users',['status' => '3'])}}" class="text-dark mb-1 mt-2 h6 d-block">
                                        <figure class="product-image"><img src="{{asset('img')}}/{{( $statuses[3]['image'])}}" alt="" ></figure>
                                    لغو شده <p class="text-danger pad-top">({{$countstatus3}})</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="subtitle"></h6>
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link text-left active" id="nav-request-tab" data-toggle="tab" href="#nav-request" role="tab" aria-controls="nav-request" aria-selected="true">
                        <div class="row">
                            <div class="col-auto align-self-center pr-1">
                                <span class="btn btn-success button-rounded-26">
                                    <img src="{{asset('img')}}/{{( $statuses[3]['image'])}}" alt="" >
                                </span>
                            </div>
                            <div class="col-auto align-self-center pr-1">
                                <h6 class="text-dark my-0">{{$statuses[$status]['title']}}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-request" role="tabpanel" aria-labelledby="nav-request-tab">
                    <ul class="list-items">
                    
                    @foreach($requestshow as $item)
                        <li>
                            <div class="row">
                                <div class="col align-self-center pr-1 text-primary">{{$item->requestid}}</div>
                                <div class="col align-self-center pr-1">{{$services[$item->typerequest]}}</div>
                                <div class="col align-self-center pr-1">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($item->CREATED_AT))}}</div>
                                @if($item->status <= 1)
                                <div class="col align-self-center pr-1"><a href="{{route('change_status_my_request',['id' => $item->id,'slug' => $item->requestid])}}"><button type="button" class="mb-2 btn btn-outline-danger">انصراف</button></a></div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    
                </div>
                <div class="row pad-top"  style="justify-content: center;">
                    {{$requestshow->render('mobile-view.partials-main.pagination')}}
                    </div>
            </div>
        </div>
        
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop