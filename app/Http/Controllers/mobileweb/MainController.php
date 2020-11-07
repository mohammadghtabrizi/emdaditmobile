<?php

namespace App\Http\Controllers\mobileweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductPrices;

use App\Models\BlogPost;

class MainController extends Controller
{
    
    public function index(){

        $activeMenu = 'home';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $productcategoryparents = ProductCategory::where('parent','=','0')->get();
        
        $lastproducts = Products::join('product_images','products.id','=','product_images.pro_id')
            ->where('product_images.image_index','=','1')
            ->select('product_images.image_source','products.id','products.name','products.slug')
            ->orderBy('products.created_at','desc')
            ->take(8)
            ->get();
            
        foreach ($lastproducts as $index => $item){
        
            $lastproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->take(1)
                ->get();
 
        }

        
        $amazingproducts = ProductPrices::join('products','product_prices.price_pro_id','=','products.id')
            ->join('product_images','product_prices.price_pro_id','=','product_images.pro_id')
            ->select('product_prices.id as price_id','product_prices.price','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.warranty_name','product_prices.warranty_date','products.id','products.name','products.slug','product_images.image_source','image_index')
            ->where('product_prices.amazing_status','=','1')
            ->where('product_images.image_index','=','1')
            ->take(6)
            ->get();

        $discountproducts = ProductPrices::join('products','product_prices.price_pro_id','=','products.id')
            ->join('product_images','product_prices.price_pro_id','=','product_images.pro_id')
            ->select('product_prices.id as price_id','product_prices.price','product_prices.discount_status','product_prices.discount_price','product_prices.discount_percent','product_prices.warranty_name','product_prices.warranty_date','products.id','products.name','product_images.image_source','image_index')
            ->where('product_prices.discount_status','=','1')
            ->where('product_images.image_index','=','1')
            ->take(6)
            ->get();

        $laptopproducts = Products::join('product_images','products.id','=','product_images.pro_id')
            ->join('product_category','products.cat_id','=','product_category.id')
            ->where('product_images.image_index','=','1')
            ->where('products.cat_id','=','9')
            ->select('product_images.image_source','products.id','products.name','products.slug','product_category.id as category_id')
            ->orderBy('products.created_at','desc')
            ->take(8)
            ->get();
        
        foreach ($laptopproducts as $index => $item){
    
            $laptopproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->take(1)
                ->get();

        }

        $mobileproducts = Products::join('product_images','products.id','=','product_images.pro_id')
            ->join('product_category','products.cat_id','=','product_category.id')
            ->where('product_images.image_index','=','1')
            ->where('products.cat_id','=','10')
            ->select('product_images.image_source','products.id','products.name','products.slug','product_category.id as category_id')
            ->orderBy('products.created_at','desc')
            ->take(8)
            ->get();
        
        foreach ($mobileproducts as $index => $item){
    
            $mobileproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->take(1)
                ->get();

        }

        $modemproducts = Products::join('product_images','products.id','=','product_images.pro_id')
            ->join('product_category','products.cat_id','=','product_category.id')
            ->where('product_images.image_index','=','1')
            ->where('products.cat_id','=','11')
            ->select('product_images.image_source','products.id','products.name','products.slug','product_category.id as category_id')
            ->orderBy('products.created_at','desc')
            ->take(8)
            ->get();
        
        foreach ($modemproducts as $index => $item){
    
            $modemproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->take(1)
                ->get();

        }
        
        $blogvieweds = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('blog_post.BP_VIEWED','>',25)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->select('blog_post.BP_TITLE','blog_files.bf_source')
            ->orderBy('blog_post.created_at','desc')
            ->take(8)
            ->get();

        
        return view('/mobile-view/index')->with([

            'productcategoryparents'=> $productcategoryparents,

            'lastproducts' => $lastproducts,

            'amazingproducts' => $amazingproducts,

            'discountproducts' => $discountproducts,

            'laptopproducts' => $laptopproducts,

            'mobileproducts' => $mobileproducts,

            'modemproducts' => $modemproducts,

            'blogvieweds' => $blogvieweds,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'activeMenu' => $activeMenu

        ]);
    }

    public function expertrequest(){

        

        $activeMenu = 'home';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $now = \Carbon\Carbon::now();

        $result = [];

        for($i = 1;$i<=3;$i++){

            $result[] = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::now()->addDays($i))->format("%Y-%m-%d");

        }

    	return view ('\mobile-view\request\request')->with([

            'activeMenu' => $activeMenu,

            'dates' => $result,

            'services' => $this->services,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle

        ]);
    }

    public function addExpert(Request $request){


        $roles = [

            'name' => 'string|min:3',

            'mobile' => 'numeric',

            'lastname' => 'string|min:5',

            'mobile' => 'numeric|min:11',

            'typerequest' => 'in:' . implode(',', array_keys($this->services)),
			
			'city' => 'in:' . implode(',', array_keys($this->citys)),
			
			'time' => 'in:' . implode(',', array_keys($this->times))
			

        ];

        $attributes = [

            'name' => 'نام',

            'lastname' => 'نام خانوادگی',

            'mobile' => 'موبایل',

            'typerequest' => 'نوع درخواست',
			
			'city' => 'شهر',
			
			'time' => 'زمان مراجعه'

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


        $r = new MeRequest();
			
		if(!Auth::check()){

            $r->name = $request->get('name');

            $r->lastname = $request->get('lastname');

            $r->mobile = $request->get('mobile');


        }
        else{

            $r->name = Auth::user()->name;

            $r->lastname = Auth::user()->lastname;

            $r->mobile = Auth::user()->mobile;


        }

        $checkregisterlicense = MeRequest::select('me_request.id')
            ->where('me_request.mobile','=',$r->mobile)
            ->where('me_request.status','=','pending')
            ->count();
        if($checkregisterlicense <= 3){

        	$r->typerequest = $request->get('typerequest');

            $r->city = $request->get('city');

            $daterequest = $request->get('date');

            $r->timerequest = $request->get('time');

            $r->address = $request->get('address');  

            $r->status = 0;

            $now = \Carbon\Carbon::now();

            $result = [];

            for($i = 1;$i<=3;$i++){

                $result[] = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::now()->addDays($i))->tostring();

            }

            $r->daterequest = $result[$daterequest];
            
            $saved = $r->save();
        
            if(!$saved){

                $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا دوباره تلاش کنید';

                $message['class'] = 'alert-warning';

                return redirect()->back()->with('message',$message);
            
            }
            else{

                if(!Auth::check()){

                    $user = User::where('users.mobile','=',$request->get('mobile'))->first();

                    if(is_null($user)){

                        $user = new User();
                
                        $user->name = $request->get('name');
                    
                        $user->mobile = $request->get('mobile');
                            
                        $user->lastname = $request->get('lastname');
                            
                        $user->password = Hash::make('PA'.'EI'.$r->id);

                        $user->points = 150;

                        $user->save();

                    }

                }
                else{

                    $user = Auth::user();

                    $points = Auth::user()->points; 

                    $points = $points + 15;;

                    $user->points = $points;

                    $user->save();

                }

                $r->userid = $user->id;
    			
    			$r->requestid = "RQE" . "01" .  $r->id;
    			
    			$r->save();
                
                $pa = 'PA'.'EI'.$r->id;


                if(!Auth::check()){
                	Smsirlaravel::send(['مشترک عزیز با سلام'.'،'.'درخواست شما با موفقیت ثبت گردید'.'نام کاربری :'.$r->mobile.'و رمز عبور شما :'.$pa.'شما می توانید با ورود به حساب کاربری خود از وضعیت درخواست خود مطلع شوید','درخواست جدیدی در سامانه ثبت شد.'],[$user->mobile,'09120924699']);

                	Smsirlaravel::send([$r->name.' '.$r->lastname.' '.'عزیز'.'به باشگاه مشتریان امداد آی تی خوش آمدید جهت استفاده از امکانات و تخفیفات ویژه به حساب کاربری خود در وب سایت ما مراجعه کنید'.'http://emdadit.com'],[$user->mobile]);
    			}
    			else{
    				
    				Smsirlaravel::send([$r->name.' '.$r->lastname.' '.'عزیز درخواست شما با موفقیت در سامانه ثبت گردید'],[$user->mobile,'09120924699']);
    				
    			}
    			
                $messagesuccessrequest['message'] = 'ثبت اطلاعات شما با موفقیت انجام شد این اطمینان به شما داده میشود که کارشناسان ما با شما در کمترین ممکن زمان تماس بگیرند .';

                $messagesuccessrequest['class'] = 'alert-success';

                $submitstatus['class'] = 'alert-success';

                $validates = $validate->errors();
    			
    		    
                return redirect()->back()->with([
                
                    'messagesuccessrequest' => $messagesuccessrequest,

                    'errorvalidate' => $validates,
        				
        			'requestids' => $r->requestid,
        				
        			'name' => $r->name,
        				
        			'mobile' => $r->mobile,

                    'password' => $pa,

                    'submitstatus' => $submitstatus

                ]);

            }
        }
        else{

            $error['class'] = 'errorregisterlicense';

            return redirect()->back()->with([

                'error' => $error
            ]);

        }

    }
}