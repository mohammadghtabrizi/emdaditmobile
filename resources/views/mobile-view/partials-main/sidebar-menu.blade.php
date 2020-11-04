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
                <h5 class="subtitle text-uppercase"><span>منو</span></h5>
                <div class="list-group main-menu">
                    
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action @if($activeMenu == 'home') active @endif">صفحه اصلی</a>
                    <a href="{{route('index')}}" class="list-group-item list-group-item-action ">فروشگاه</a>
                    <a href="{{route('expertrequest')}}" class="list-group-item list-group-item-action">درخواست کارشناس </a>
                    <a href="#" class="list-group-item list-group-item-action"> CTRL+P </a>
                    @if(!Auth::check())
                    <a href="{{route('login_front_end_user')}}" class="list-group-item list-group-item-action mt-4">ورود/ثبت نام</a>
                    @endif
                    @if(Auth::check())
                    <a href="{{route('dashboard_users')}}" class="list-group-item list-group-item-action"> پروفایل </a>
                    <a href="{{route('logout_front_end_user')}}" class="list-group-item list-group-item-action mt-4">خروج از سیستم</a>
                    @endif
                </div>
            </div>
        </div>

    </div>