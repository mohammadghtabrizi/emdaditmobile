        <div class="container">
            <h6 class="subtitle">به روز رسانی های خبری</h6>
            <div class="row">
                <!-- Swiper -->
                <div class="swiper-container news-slide">
                    <div class="swiper-wrapper">
                        @foreach($blogvieweds as $blogviewed)
                        <div class="swiper-slide">
                            <div class="card shadow-sm border-0 bg-dark text-white">
                                <figure class="background">
                                    <img src="{{asset('img/post-images')}}/{{ $blogviewed->bf_source }}" alt="">
                                    
                                </figure>
                                <div class="card-body">
                                    <a href="#" class="btn btn-default button-rounded-36 shadow-sm float-bottom-right"><i class="material-icons md-18">arrow_back</i></a>
                                    <h5 class="small">{{$blogviewed->BP_TITLE}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>