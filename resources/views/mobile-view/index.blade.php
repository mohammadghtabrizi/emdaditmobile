@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        @include('mobile-view.product-view.product-index')
        @include('mobile-view.blog-view.blog-index')
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-loading')
    <!-- notification ends -->
    
@stop
