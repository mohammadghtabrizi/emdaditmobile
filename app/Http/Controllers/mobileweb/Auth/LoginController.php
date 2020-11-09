<?php

namespace App\Http\Controllers\mobileweb\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UsersVerification;



class LoginController extends Controller
{

    public function index(){

        return view('/mobile-view/auth/login');
    }

    public function login(Request $request){
        
        $username = $request->get('mobile');
        
        $getuser = User::where('users.mobile','like',$username)
        ->get();
    
        if(!is_null($getuser->first())){
            return redirect()->route('verification_front_end_user')->with('user',$getuser);
        }

        if(is_null($getuser->first())){
            return route('register_view_user')->with([]);
        }

        

        // if(!Auth::attempt(['mobile' => $username, 'password' => $pass], $remember_me)) {
            
            
        //     Session::flash('login_faild','نام کاربری یا رمزعبور اشتباه می باشد!');

        //     $message['message'] = 'نام کاربری یا رمزعبور اشتباه می باشد!';

        //     $message['class'] = '-danger';

        //     return redirect()->back()->with('message',$message);

        // }

        // return redirect()->route('dashboard_users');
        

    }

    public function userverification(){
        
        $user = session('user');
        
        if(!is_null($user)){
            
            $mobile = $user->first()->mobile;

        }
        else{

            return redirect()->back();
        }
        

        return view('mobile-view/auth/user-verification')->with([

            'mobile' => $mobile

        ]);

    }


}
