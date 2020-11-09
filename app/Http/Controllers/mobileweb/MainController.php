<?php

namespace App\Http\Controllers\mobileweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductPrices;
use App\Models\MeRequest;

use App\Models\BlogPost;

use Validator;

use Auth;
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

            'citys' => $this->citys,

            'times' => $this->times,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle

        ]);
    }

    public function addExpert(Request $request){


        $roles = [

            // 'name' => 'required|string|min:3',

            // 'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11',

            // 'lastname' => 'required|string|min:5',

            'typerequest' => 'required|in:' . implode(',', array_keys($this->services)),
			
			'city' => 'required|in:' . implode(',', array_keys($this->citys)),
			
			'time' => 'required|in:' . implode(',', array_keys($this->times))
			

        ];

        $attributes = [

            // 'name' => 'نام',

            // 'lastname' => 'نام خانوادگی',

            // 'mobile' => 'موبایل',

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

            $message['class'] = '-danger';

            return redirect()->back()->withErrors($validate)->with('message',$message);
        }

        $checkrequestuser = MeRequest::where('me_request.userid','=',Auth::user()->id)
        ->where('me_request.status','=',0)
        ->count();

        if($checkrequestuser > 3){

            $message['message'] = 'کاربر عزیز شما بیشتر از 3 درخواست درحال پیگیری نمی توانید داشته باشید .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        $r = new MeRequest();
			
		if(!Auth::check()){

            return route('login_front_end_user_view');


        }
        else{

            $r->name = Auth::user()->name;

            $r->lastname = Auth::user()->lastname;

            $r->mobile = Auth::user()->mobile;


        }
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

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        
        }
        else{

            

            $r->userid = Auth::user()->id;
            
            $r->requestid = "RQE" . "01" .  $r->id;
            
            $r->save();
            
            $pa = 'PA'.'EI'.$r->id;
            
            $message['message'] = 'ثبت اطلاعات شما با موفقیت انجام شد این اطمینان به شما داده میشود که کارشناسان ما با شما در کمترین ممکن زمان تماس بگیرند .';

            $message['class'] = '-primary';

            $validates = $validate->errors();
            
            
            return redirect()->back()->with([


                'errorvalidate' => $validates,

                'message' => $message
                    

            ]);

        }

    }
}