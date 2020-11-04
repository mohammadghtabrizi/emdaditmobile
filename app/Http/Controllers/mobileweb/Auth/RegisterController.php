<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Http\Controllers\Controller;

use App\User;

use Hash;

use Validator;

class RegisterController extends Controller
{
    public function registerview(){

    	

        return view('/auth/register-view')->with([


        ]);
    }

    public function registeradd(Request $request){

    	$roles = [

            'name' => 'string|min:3',

            'mobile' => 'numeric',

            'lastname' => 'string|min:3',

            'email' => 'email',

            'password' => 'min:8'
			

        ];

        $attributes = [

            'name' => 'نام',

            'lastname' => 'نام خانوادگی',

            'mobile' => 'موبایل',

            'email' => 'ایمیل',

            'password' => 'کلمه عبور'

        ];

        $messages = [

            'email' => 'مقدار :attribute باید در فرمت ایمیل باشد.',

            'numeric' => 'مقدار :attribute باید در نوع عددی باشد'

        ];


        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        
        if($validate->fails()){

            $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا خطاهای زیر را بررسی و دوباره امتحان نمایید .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->withErrors($validate)->with('message',$message);


        }

        $password = $request->get('password');

        if(!is_null($password) && $password != ''){

            if($password != $request->get('password-confirm')){
				

                $message['message'] = 'پسورد باید با تکرار آن برابر باشد';

            	$message['class'] = 'alert-warning';

                return redirect()->back()->with('message',$message);

            }
            $adduser = new User();

            $adduser->password = Hash::make($password);

        }




        $userexist = User::where('users.mobile','=',$request->get('mobile'))->first();

        if(is_null($userexist)){


    		
    		$adduser->name = $request->get('name');
    		$adduser->lastname = $request->get('lastname');
    		$adduser->email = $request->get('email');
    		$adduser->mobile = $request->get('mobile');

    		$saved = $adduser->save();

    		if(!$saved){

                $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا دوباره تلاش کنید';

                $message['class'] = 'alert-warning';

                return redirect()->back()->with('message',$message);
            
            }

            $message['message'] = 'ثبت نام شما با موفقیت انجام شد .';

            $message['class'] = 'alert-success';

            return redirect()->back()->with('message',$message);

    	}
    	else{

    		$message['message'] = 'متاسفانه کاربری با این شماره همراه وجود دارد و امکان ثبت نام مجدد نیست';

            $message['class'] = 'alert-warning';

            return redirect()->back()->with('message',$message);


    	}


    }
}
