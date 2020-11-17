<?php

namespace App\Http\Controllers\mobileweb\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UsersVerification;

use \Carbon\Carbon;

use Validator;


class LoginController extends Controller
{

    public function index(){

        return view('/mobile-view/auth/login');
    }

    public function login(Request $request){

        $roles = [

            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',
			
        ];

        $attributes = [

            'mobile' => 'موبایل',

        ];

        $messages = [

            

        ];


        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        
        if($validate->fails()){

            $message['message'] = 'شماره وارد شده صحیح نمی باشد .';

            $message['class'] = '-danger';

            return redirect()->back()->withErrors($validate)->with('message',$message);


        }
        
        $username = $request->get('mobile');
        
        $getuser = User::where('users.mobile','like',$username)
        ->first();

        if(is_null($getuser)){

            return redirect()->route('register_view_user')->with('mobile',$username);

        }
    
        $now = Carbon::now();
    
        $perverificationcode = UsersVerification::where('users_verification.user_id','=',$getuser->id)
        ->where('users_verification.count','<',6)
        ->where('users_verification.expireat','>',$now)
        ->orderBy('users_verification.created_at','desc')
        ->first();
        
        if(!is_null($perverificationcode)){
            
            $countsms = UsersVerification::where('id', $perverificationcode->id)->update(['count' => $perverificationcode->count + 1]);
            

            $message['message'] = 'کد تایید برای شما ارسال شده است لطفا پس از 2 دقیقه تلاش کنید .';

            $message['class'] = '-danger';

            return redirect()->route('verification_user_view',['mobile' => $getuser->mobile])->with([
            
                'message' => $message
                
                
            ]);

        }
        else{
            
            $code = '123456';

            $addverification = new UsersVerification();

            $addverification->user_id = $getuser->id;

            $addverification->code = $code;

            $addverification->expireat = Carbon::now()->addMinutes(2);

            $count = 1;

            $save = $addverification->save();

            $message['message'] = 'کد تایید برای شماره موبایل شما با موفقیت ارسال گردید .';

            $message['class'] = '-primary';

            return redirect()->route('verification_user_view',['mobile' => $getuser->mobile])->with([

                'message' => $message
                
            
            ]);
        }


    }

    public function userverificationview(Request $request){
        
        $mobile = $request->get('mobile');
        
        if(!is_null($mobile)){
            
            return view('mobile-view/auth/user-verification')->with([

                'mobile' => $mobile,

                'message' => session('message')
    
            ]);
            
        }
        
        

        return redirect()->route('login_front_end_user_view');

    }

    public function userverification(Request $request){

        $roles = [

            'code' => 'required|numeric',

            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11'
            
        ];

        $attributes = [

            'code' => 'کد تایید',

            'mobile' => 'موبایل',

        ];

        $messages = [


        ];


        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        
        if($validate->fails()){
            
            $message['message'] = 'کد تایید وارد شده صحیح نمی باشد .';

            $message['class'] = '-danger';

            return redirect()->route('verification_user_view',['mobile' => $request->get('mobile')])->withErrors($validate)->with('message',$message);


        }

        //if ro ok konim

        $verificationfinal = User::join('users_verification','users.id','=','users_verification.user_id')
        ->where('users.mobile','=',$request->get('mobile'))
        ->where('users_verification.code','=',$request->get('code'))
        ->select('users.*')
        ->first();
        
        if(is_null($verificationfinal)){

            $message['message'] = 'کد تایید اشتباه است .';

            $message['class'] = '-danger';

            return redirect()->route('verification_user_view',['mobile' => $request->get('mobile')])->with([

                'message' => $message
                
            
            ]);

        }

        auth()->login($verificationfinal);

        return redirect()->route('dashboard_users');
    
    }


}
