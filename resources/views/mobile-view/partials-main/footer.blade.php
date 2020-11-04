        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                     <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="{{route('dashboard_users')}}" class="btn @if($activeMenu == 'myprofile') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">account_circle</i>myprofile
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">favorite</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn @if($activeMenu == 'shop') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">local_mall</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link-default">
                                <i class="material-icons">insert_chart_outline </i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('index')}}" class="btn @if($activeMenu == 'home') btn-default  shadow centerbutton active @else btn btn-link-default @endif">
                                <i class="material-icons">store_mall_directory</i>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>