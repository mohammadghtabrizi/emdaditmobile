@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <div class="container">
            <div class="h4">
                <div class="d-inline-block">جزئیات سفارش<br>
                    <p class="small text-primary">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($getproductcart->created_at))}} | {{$getproductcart->pc_cart_id}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item active">
                            <h6 class="mb-0">18 تیر 1399</h6>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-4.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">مبل خاکستری</a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="5">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-5.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">میز عتیقه </a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="3">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-6.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">مبل راحتی</a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="11">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>  به روز کنید</span> <i class="material-icons">arrow_back </i> </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item active">
                            <h6 class="mb-0">15 مرداد 1399</h6>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-4.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">مبل خاکستری</a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="5">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-5.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">میز عتیقه </a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="3">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-sm btn-link text-danger p-0 float-right"><i class="material-icons">delete</i></button>
                                </div>
                                <div class="col-2 pl-0 align-self-center">
                                    <figure class="product-image h-auto"><img src="img/image-6.png" alt="" class="vm"></figure>
                                </div>
                                <div class="col px-0">
                                    <a href="#" class="text-dark mb-1 h6 d-block">مبل راحتی</a>
                                    <h5 class="text-success font-weight-normal mb-0">120 تومان</h5>
                                    <p class="text-secondary small text-mute mb-0">1.0 کیلوگرم <span class=" text-success ml-2">10٪ تخفیف</span></p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">remove</i></button>
                                        </div>
                                        <input type="text" class="form-control w-35" placeholder="" value="11">
                                        <div class="input-group-append">
                                            <button class="btn btn-light-grey px-1" type="button"><i class="material-icons">add</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>به روز کنید</span> <i class="material-icons">arrow_back </i> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop