@extends('mobile-view.partials-main.body-main')
@section('body-main-content')
    @include('mobile-view.partials-main.loader-screen')
    @include('mobile-view.partials-main.sidebar-menu')
    <div class="wrapper">
        @include('mobile-view.partials-main.top-main-menu')
        <!-- is-invalid -->
        <div class="container">
            <h1>درخواست کارشناس</h1>
            <!-- page content here -->
            <form action="{{route('store_expertrequest')}}"  method="post">
                @php($user = Auth::user())
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group float-label">
                            <select id="form_typerequest" name="typerequest" class="form-control" required="required">
                                <option></option>
                                @foreach($services as $skey => $svalue)

                                <option value="{{ $skey }}">{{ $svalue }}</option>

                                @endforeach
                            </select>
                            <label class="form-control-label" for="form_typerequest">نوع درخواست *</label>
                            @error('typerequest')
                            <div class="help-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group float-label">
                            <select id="form_city" name="city" class="form-control" required="required">
                            <option></option>
                            @foreach($citys as $skey => $svalue)

                            <option value="{{ $skey }}">{{ $svalue }}</option>

                            @endforeach
                            </select>
                            <label class="form-control-label" for="form_city">انتخاب استان *</label>
                            @error('city')
                            <div class="help-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group float-label">
                            <select id="form_date" name="date" class="form-control" required="required">
                                <option></option>
                                @foreach($dates as $index => $date)
        
                                <option value="{{$index}}">{{$date}}</option>
        
                                @endforeach
                            </select>
                            <label class="form-control-label" for="form_date">تاریخ مراجعه کارشناس *</label>
                            @error('date')
                            <div class="help-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group float-label">
                            <select id="form_time" name="time" class="form-control" required="required">
                                <option></option>
                                @foreach($times as $skey => $svalue)

                                <option value="{{ $skey }}">{{ $svalue }}</option>

                                @endforeach
                            </select>
                            <label class="form-control-label" for="form_time">زمان مراجعه کارشناس *</label>
                            @error('time')
                            <div class="help-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group float-label">                        
                            <textarea id="form_adderess" name="address" class="form-control" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                            <label class="form-control-label" for="form_adderess">آدرس  </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center mt-3">
                        <button class="btn btn-default btn-rounded btn-lg shadow" type="submit">درخواست کارشناس</button>
                    </div>
                </div>
            </form>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p class="text-muted">
                        <strong>*</strong> فیلدهای ستاره دار الزامی است.
                </p></div>
            </div>
            

            <!-- page content ends -->
        </div>
        @include('mobile-view.partials-main.footer')
    </div>
    <!-- notification -->
    @include('mobile-view.partials-main.notification-fullscreen')
    <!-- notification ends -->
    
@stop
