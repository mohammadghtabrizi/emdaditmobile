        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                     <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="{{route('dashboard_users')}}" class="btn @if($activeMenu == 'myprofile') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">account_circle</i>myprofile
                            </a>
                        </div>
                        @if(Auth::check())
                        <div class="col-auto">
                            <a href="{{route('request_history_users')}}" class="btn @if($activeMenu == 'shop') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">build</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('show_my_favorites')}}" class="btn btn-link-default">
                                <i class="material-icons">favorite</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('show_my_cart')}}" class="btn @if($activeMenu == 'shop') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">local_mall</i>
                            </a>
                        </div>
                        @endif
                        <div class="col-auto">
                            <a href="{{route('index')}}" class="btn @if($activeMenu == 'home') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">store_mall_directory</i>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>