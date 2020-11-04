    @if(Session::has('message'))
        
        @php($message = Session::get('message')) 

        @if ($message['class'] == '-primary')
        <div class="notification bg-white shadow border{{$message['class']}}">
            <div class="row">
                <div class="col-auto align-self-center pr-0">
                    <i class="material-icons text{{$message['class']}} md-36">done</i>
                </div>
                <div class="col">
                    <h6 class="text{{$message['class']}}">عملیات با موفقیت انجام شد .</h6>
                    <p class="mb-0 text-secondry">{{$message['message']}}</p>
                </div>
                <div class="col-auto align-self-center pl-0">
                    <button class="btn btn-link closenotification"><i class="material-icons text{{$message['class']}} text-mute md-18 ">close</i></button>
                </div>
            </div>
        </div>

        @endif

    @endif

    @if(Session::has('message'))
    
        @php($message = Session::get('message')) 

        @if ($message['class'] == '-danger')
        <div class="notification bg-white shadow border{{$message['class']}}">
            <div class="row">
                <div class="col-auto align-self-center pr-0">
                    <i class="material-icons text{{$message['class']}} md-36">error</i>
                </div>
                <div class="col">
                    <h6 class="text{{$message['class']}}">خطای رخ داده است !</h6>
                    <p class="mb-0 text-secondry">{{$message['message']}}</p>
                </div>
                <div class="col-auto align-self-center pl-0">
                    <button class="btn btn-link closenotification"><i class="material-icons text{{$message['class']}} text-mute md-18 ">close</i></button>
                </div>
            </div>
        </div>

        @endif

    @endif

    