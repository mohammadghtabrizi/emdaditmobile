<?php

namespace App\Http\Controllers\mobileweb\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Session;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UsersVerification;

use Validator;

use \Carbon\Carbon;

class RegisterController extends Controller
{
    public function registerview(){

        return view('/mobile-view/auth/register-view')->with([

        ]);
    }

    public function registeradd(Request $request){

    	$roles = [

            'name' => 'required|string|min:3',

            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',

            'lastname' => 'required|string|min:5',
			
        ];

        $attributes = [

            'name' => 'نام',

            'lastname' => 'نام خانوادگی',

            'mobile' => 'موبایل',

        ];

        $messages = [

            'email' => 'مقدار :attribute باید در فرمت ایمیل باشد.',

            'numeric' => 'مقدار :attribute باید در نوع عددی باشد'

        ];


        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        
        if($validate->fails()){

            $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا خطاهای زیر را بررسی و دوباره امتحان نمایید .';

            $message['class'] = '-danger';

            return redirect()->back()->withErrors($validate)->with('message',$message);


        }

        $userexist = User::where('users.mobile','=',$request->get('mobile'))->first();

        if(is_null($userexist)){


    		$adduser = new User();
    		$adduser->name = $request->get('name');
    		$adduser->lastname = $request->get('lastname');
    		$adduser->mobile = $request->get('mobile');

            $saved = $adduser->save();

    		if(!$saved){

                $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا دوباره تلاش کنید';

                $message['class'] = '-danger';

                return redirect()->back()->with('message',$message);
            
            }

            $code = '123456';

            $addverification = new UsersVerification();

            $addverification->user_id = $adduser->id;
            $addverification->code = $code;
            $addverification->expireat = Carbon::now()->addMinutes(2);
            $count = 1;

            $save = $addverification->save();

            $message['message'] = 'کد تایید برای شماره موبایل شما با موفقیت ارسال گردید .';

            $message['class'] = '-primary';

            return redirect()->route('verification_user_view',['mobile' => $request->get('mobile')])->with([
                
                'user' => $adduser,

                'message' => $message
                
            
            ]);

    	}
    	else{

    		$message['message'] = 'شما قبلا با این شماره همراه ثبت نام کرده اید .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);


    	}


    }
}
