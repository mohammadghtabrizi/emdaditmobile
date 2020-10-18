        <div class="container">
            <input type="text" class="form-control form-control-lg search my-3" placeholder="جستجو کردن">
            <div data-pagination='{"el": ".swiper-pagination"}' data-loop="true" class="swiper-index-slider swiper-init demo-swiper">
                <div class="swiper-pagination"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="img/product5.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product4.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product3.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product2.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product1.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product5.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product4.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product3.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product2.jpg" alt="" ></div>
                    <div class="swiper-slide"><img src="img/product1.jpg" alt="" ></div>
                </div>
            </div>
            <h6 class="subtitle">دسته بندی ها</h6>
            <div class="row">
                @foreach($productcategoryparents as $productcategoryparent)
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body text-center p-4">
                            <img src="{{asset('img/products/categories')}}/{{ $productcategoryparent->image_source }}" alt="" class="small-slide-right">
                            <h5 class="mb-1" style="padding-top:15px;">{{$productcategoryparent->name}}</h5>
                            <br>
                            <button class="btn btn-outline-primary btn-sm">نمایش</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid bg-amazing-product text-dark my-3">
            <h1 class="subtitle text-white">تخفیف های شگفت انگیز <a href="all-products.html" class="float-right small">مشاهده همه</a></h1>
            <div class="row">
                @foreach ($amazingproducts as $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <div class="badge badge-success float-right mt-1">{{$item->amazing_percent}}&nbsp;تخفیف</div>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            <del>{{ $item->price }}</del>
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->amazing_price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h6 class="subtitle">محصولات جدید <a href="all-products.html" class="float-right small">مشاهده همه</a></h6>
            <div class="row">
                @foreach ($lastproducts as $index => $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->price->first()->warranty_date}}<br>{{$item->price->first()->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid bg-discount-product text-dark my-3">
            <h1 class="subtitle text-white">تخفیف های امروز <a href="all-products.html" class="float-right small">مشاهده همه</a></h1>
            <div class="row">
                @foreach ($discountproducts as $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <div class="badge badge-primary float-right mt-1">{{$item->discount_percent}}&nbsp;تخفیف</div>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            <del>{{ $item->price }}</del>
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->discount_price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->warranty_date}}<br>{{$item->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container mb-3">
            <div class="row">
                <div class="col text-center">
                    <h5 class="subtitle mb-1">هیجان انگیزترین ویژگی</h5>
                    <p class="text-secondary">نگاهی به خدمات ما بیندازید</p>
                </div>
            </div>
            <div class="row text-center mt-4">
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="material-icons mb-4 md-36 text-template">card_giftcard</i>
                            <h2>2546</h2>
                            <p class="text-secondary text-mute">هدیه بده</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="material-icons mb-4 md-36 text-template">subscriptions</i>
                            <h2>635</h2>
                            <p class="text-secondary text-mute">صورتحساب ماهانه</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="material-icons mb-4 md-36 text-template">local_florist</i>
                            <h2>1542</h2>
                            <p class="text-secondary text-mute">محیط زیست</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <i class="material-icons mb-4 md-36 text-template">location_city</i>
                            <h2>154</h2>
                            <p class="text-secondary text-mute">چهار دفتر</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h6 class="subtitle">لپ تاپ <a href="all-products.html" class="float-right small">مشاهده همه</a></h6>
            <div class="row">
                @foreach ($laptopproducts as $index => $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->price->first()->warranty_date}}<br>{{$item->price->first()->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h6 class="subtitle">گوشی موبایل <a href="all-products.html" class="float-right small">مشاهده همه</a></h6>
            <div class="row">
                @foreach ($mobileproducts as $index => $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->price->first()->warranty_date}}<br>{{$item->price->first()->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h6 class="subtitle">مودم ADSL <a href="all-products.html" class="float-right small">مشاهده همه</a></h6>
            <div class="row">
                @foreach ($modemproducts as $index => $item)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <button class="btn btn-sm btn-link p-0"><i class="material-icons md-18">favorite_outline</i></button>
                            <figure class="product-image"><img src="{{asset('img/products/images')}}/{{( $item->image_source )}}" alt="" class=""></figure>
                            <a href="product-details.html" class="text-dark mb-1 mt-2 h6 d-block">{{$item->name}}</a>
                            
                            <h5 class="text-success font-weight-normal mb-0">{{ $item->price->first()->price }}</h5>
                            <p class="text-discount small text-mute mb-0">گارانتی {{$item->price->first()->warranty_date}}<br>{{$item->price->first()->warranty_name}}</p>
                            <button class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">shopping_cart</i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>