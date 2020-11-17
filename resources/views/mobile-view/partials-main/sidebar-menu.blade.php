    <div class="sidebar">
        @if(Auth::check())
        <div class="text-center">
            <div class="figure-menu shadow">
                <figure><img src="{{asset('img/dashboard/users/profile')}}/{{Auth::user()->userpicture}}" alt=""></figure>
            </div>
            <h5 class="mb-1 ">{{Auth::user()->name}} {{Auth::user()->lastname}}</h5>
            <p class="text-mute small">امتیاز شما {{Auth::user()->points}}</p>
        </div>
        <br>
        @else
        @endif
        <div class="row mx-0">
            <div class="col">
                @if(Auth::check())
                @if(Auth::user()->wallet_status === 1)
                <div class="card mb-3 border-0 shadow-sm bg-template-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p class="text-secondary small mb-0">موجودی شما </p>
                                <h6 class="text-dark my-0">{{Auth::user()->wallet}} &#8203;&#8203;تومان</h6>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-default button-rounded-36 shadow"><i class="material-icons">add</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                <h5 class="subtitle text-uppercase text-warning"><span>منو اصلی</span></h5>
                <div class="list-group main-menu">
                    
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action @if($activeMenu == 'home') active @endif">صفحه اصلی</a>
                    @if(!Auth::check())
                    <a href="{{route('expertrequest')}}" class="list-group-item list-group-item-action">درخواست کارشناس </a>
                    <a href="#" class="list-group-item list-group-item-action"> CTRL+P </a>
                    <a href="{{route('login_front_end_user')}}" class="list-group-item list-group-item-action">ورود/ثبت نام</a>
                    @endif
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action ">درباره ما</a>
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action ">تماس با ما</a>
                </div>
                <h5 class="subtitle text-uppercase text-warning"><span>دسته بندی ها</span></h5>
                <div class="list-group main-menu">
                    
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action">ماشین های اداری</a>
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action">کامپیوتر و لپ تاپ</a>
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action">مودم و تجهیزات شبکه</a>
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action">موبایل</a>
                </div>
                @if(Auth::check())
                <h5 class="subtitle text-uppercase text-warning"><span>امداد آی تی من</span></h5>
                <div class="list-group main-menu">
                    <a href="{{route('expertrequest')}}" class="list-group-item list-group-item-action">درخواست کارشناس </a>
                    <a href="#" class="list-group-item list-group-item-action"> CTRL+P </a>
                    @if(Auth::check())
                    <a href="{{route('logout_front_end_user')}}" class="list-group-item list-group-item-action mt-4">خروج از سیستم</a>
                    @endif
                </div>
                @endif
            </div>
        </div>

    </div>