        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn  btn-link text-dark menu-btn"><img src="{{asset('img/menu.png')}}" alt=""><span class="new-notification"></span></button>
                </div>
                <div class="col text-center"><img src="{{asset('img/emdaditlogologin.png')}}" alt="" class="header-logo"></div>
                <div class="col-auto">
                    <a href="{{route('dashboard_users')}}" class="btn  btn-link text-dark"><i class="material-icons">account_circle</i></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="input-group mb-3" style="padding-top:20px;">
                <form class="input-group form-group" method="get" action="{{route('search_product')}}">
                    <input type="search" class="form-control" name="searchproduct" placeholder="دنبال چه میگردید">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-secondary" placeholder="" value="جستجو">
                    </div>
                </form>
            </div>
        </div>