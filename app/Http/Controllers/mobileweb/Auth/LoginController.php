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
        ->get();

        $getuser = $getuser->first();
    
        if(!is_null($getuser)){

            $now = Carbon::now();
            
    
            $perverificationcode = UsersVerification::where('users_verification.user_id','=',$getuser->id)
            ->where('users_verification.count','<',6)
            ->where('users_verification.expireat','>',$now)
            ->orderBy('users_verification.created_at','desc')
            ->get();

            $perverificationcode = $perverificationcode->first();

            
            if(!is_null($perverificationcode)){
                
                $countsms = UsersVerification::where('id', $perverificationcode->id)->update(['count' => $perverificationcode->count + 1]);
                

                $message['message'] = 'کد تایید برای شما ارسال شده است لطفا پس از 2 دقیقه تلاش کنید .';

                $message['class'] = '-danger';

                return redirect()->route('verification_user_view')->with([
                
                    'message' => $message,

                    'user' => $getuser
                    
                    
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

                return redirect()->route('verification_user_view')->with([
                    
                    'user' => $getuser,

                    'message' => $message
                    
                
                ]);
            }
            
        }
        else{

            return redirect()->route('register_view_user');

        }
        

        // if(!Auth::attempt(['mobile' => $username, 'password' => $pass], $remember_me)) {
            
            
        //     Session::flash('login_faild','نام کاربری یا رمزعبور اشتباه می باشد!');

        //     $message['message'] = 'نام کاربری یا رمزعبور اشتباه می باشد!';

        //     $message['class'] = '-danger';

        //     return redirect()->back()->with('message',$message);

        // }

        // return redirect()->route('dashboard_users');
        

    }

    public function userverificationview(Request $request){
        
        $user = session('user');
        
        if(!is_null($user)){
            
            return view('mobile-view/auth/user-verification')->with([

                'user' => $user,

                'message' => session('message')
    
            ]);
            
        }
        
        

        return redirect()->route('login_front_end_user_view');

    }

    public function userverification(Request $request){

        $roles = [

            'code' => 'required|numeric|min:6|max:6',
            
        ];

        $attributes = [

            'code' => 'کد تایید',

        ];

        $messages = [


        ];


        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        
        if($validate->fails()){
            
            $message['message'] = 'کد تایید وارد شده صحیح نمی باشد .';

            $message['class'] = '-danger';

            return redirect()->route('verification_user_view')->withErrors($validate)->with('message',$message);


        }
        
    
    }


}
