        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                     <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="" class="btn btn-link-default">
                                <i class="material-icons">account_circle</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="favorite-products.html" class="btn btn-link-default">
                                <i class="material-icons">favorite</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="cart.html" class="btn btn-link-default @if($activeMenu == 'shop') shadow centerbutton @endif">
                                <i class="material-icons">local_mall</i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="statistics.html" class="btn btn-link-default">
                                <i class="material-icons">insert_chart_outline </i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('index')}}" class="btn btn-default @if($activeMenu == 'home') shadow centerbutton @endif">
                                <i class="material-icons">store_mall_directory</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>