<?php

namespace App\Http\Controllers\mobileweb\Auth\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\MeRequest;
use App\Models\BlogPost;
use App\Models\Products;
use App\Models\ProductPrices;
use App\Models\Transaction;
use App\Models\ProductCart;
use App\Models\ProductOrders;
use App\Models\ProductOrdersRelation;
use App\Models\Discount;

use Auth;

use Hash;

use Session;

use Validator;

class MainDashboardController extends Controller
{   

    public function Homeprofile(){

        $activeMenu = 'myprofile';
        
        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $orders = ProductOrders::where('product_orders.po_user_id','=',Auth::user()->id)
        ->select('product_orders.po_id','product_orders.po_order_id','product_orders.po_price_purchased','product_orders.po_status','product_orders.created_at')
        ->orderBy('product_orders.created_at','desc')
        ->take(10)
        ->get();


        $transaction = Transaction::where('transaction.user_id','=',Auth::user()->id)
        ->orderBy('transaction.created_at','desc')
        ->take(10)
        ->get();

        $merequest = MeRequest::where('me_request.userid','=',Auth::user()->id)
        ->orderBy('me_request.created_at','desc')
        ->take(10)
        ->get();

    	$date = \Morilog\Jalali\Jalalian::forge('now')->format('%d %B، %Y');

        $countrequests = MeRequest::where('userid','=',Auth::user()->id)->count();

    	return view('/mobile-view/dashboard/dashboard-index')->with([

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

    		'activeMenu' => $activeMenu,

    		'datenow' => $date,

            'countrequests' => $countrequests,

            'orders' => $orders,

            'transaction' => $transaction,

            'merequest' => $merequest,

            'statuses' => $this->statuses,

            'services' => $this->services,

            'orderstatuses' => $this->orderstatuses

    	]);
    }


    public function showmyaddress(){

        $activeMenu = '';
        
        $activeMenuDashboard = 'myaddress';

        $date = \Morilog\Jalali\Jalalian::forge('now')->format('%d %B، %Y');

        $countrequests = MeRequest::where('userid','=',Auth::user()->id)->count();

        return view('/auth/dashboard/user-address')->with([

            'activeMenu' => $activeMenu,
            
            'activeMenuDashboard' => $activeMenuDashboard,

            'datenow' => $date,

            'statuses' => $this->statuses,

            'services' => $this->services,

            'countrequests' => $countrequests

        ]);
    }

    public function UpdateUserProfile(Request $request){

        
        
        $roles = [

            'name' => 'required|string|min:3',

            'lastname' => 'required|string|min:5',

            'email' => 'nullable|email'

        ];

        $attributes = [

            'name' => 'نام',

            'lastname' => 'نام خانوادگی',

            'email' => 'ایمیل'

        ];

        $messages = [

            'required' => 'وارد کردن مقدار :attribute اجباری می باشد',

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

        $user = Auth::user();

        $user->name = $request->get('name');

        $user->lastname = $request->get('lastname');

        $user->email = $request->get('email');

        $newsletters = $request->get('newsletters');
        
        if($newsletters == "true"){
            
            $user->newsletters = 1;
        }
        else{
            $user->newsletters = 0;
        }

        if(!is_null($password) && $password != ''){

            if($password != $request->get('passwordre')){
				

                $message['message'] = 'پسورد باید با تکرار آن برابر باشد';

            	$message['class'] = 'alert-warning';

                return redirect()->back()->with('message',$message);

            }

            $user->password = Hash::make($request->get('password'));

        }

        $user->save();


        $message['message'] = 'بروزرسانی اطلاعات شما با موفقیت انجام شد .';

        $message['class'] = 'alert-success';

        return redirect()->back()->with('message',$message);
    	
    }


    public function UpdateUserAddress(Request $request){

        $roles = [
			
			'nameplace' => 'required|string|min:2',

			'state' => 'required|string|min:2',
			
			'city' => 'required|string|min:2',
			
			'address1' => 'required|string|min:8',

            'postalcode' => 'max:10|min:10'

        ];

        $attributes = [

            'nameplace' => 'نام واحد',

            'state' => 'استان',

            'city' => 'شهر',
			
			'address1' => 'آدرس 1',
			
			'postalcode' => 'کدپستی'

        ];

        $messages = [

            'required' => 'وارد کردن مقدار :attribute اجباری می باشد'

        ];

        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
        

        if($validate->fails()){

            $message['message'] = 'مشکلی در ثبت اطلاعات شما به وجود آمده لطفا خطاهای زیر را بررسی و دوباره امتحان نمایید .';

            $message['class'] = 'alert-warning';

            return redirect()->back()->withErrors($validate)->with('message',$message);

        }

        $user = Auth::user();

        $user->nameplace = $request->get('nameplace');

        $user->state = $request->get('state');

        $user->city = $request->get('city');

        $user->postalcode = $request->get('postalcode');

        $user->address1 = $request->get('address1');

        $user->address2 = $request->get('address2');

        $user->save();
		
		$message['message'] = 'بروزرسانی اطلاعات شما با موفقیت انجام شد .';

        $message['class'] = 'alert-success';

        return redirect()->back()->with('message',$message);
    	
        
    }



    public function requesthistory(Request $request){

        $activeMenu = '';
        
        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $status = $request->get('status');

        if(is_null($request->get('status'))){

            $status = 0;
        }


        $requestshow = MeRequest::where('me_request.status','=',$status)
        ->where('me_request.userid','=',Auth::user()->id)
        ->orderBy('me_request.created_at','desc')
        ->paginate(15);

        $requests = MeRequest::where('me_request.userid','=',Auth::user()->id)
        ->orderBy('me_request.status','asc')
        ->get();

        $countstatus0 = 0;
        $countstatus1 = 0;
        $countstatus2 = 0;
        $countstatus3 = 0;

        foreach($requests as $index => $item){

             if($item->status === 0){
                
                $countstatus0 = $countstatus0 + 1;
                
            }elseif($item->status === 1){

                $countstatus1 = $countstatus1 + 1;

            }elseif($item->status === 2){

                $countstatus2 = $countstatus2 + 1;
                
            }elseif($item->status === 3){

                $countstatus3 = $countstatus3 + 1;
                
            }


        }

        

        return view('mobile-view\dashboard\request-history')->with([


            'activeMenu' => $activeMenu,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'statuses' => $this->statuses,

            'services' => $this->services,
          
            'countstatus0' => $countstatus0,

            'countstatus1' => $countstatus1,

            'countstatus2' => $countstatus2, 

            'countstatus3' => $countstatus3,   
            
            'requestshow' => $requestshow->appends($request->except('page')),

            'status' => $status,


        ]);
    }

    public function changestatusrequest(Request $request,$id,$slug=''){
        
        $findMeRequest = MeRequest::where('me_request.id','=',$id)
        ->first();

        if(is_null($findMeRequest)){

            $message['message'] = 'درخواست مورد نظر یافت نشد لطفا دوباره تلاش کنید .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }

        $findMeRequest->status = 3;

        $save = $findMeRequest->save();

        if(!$save){

            $message['message'] = 'عملیات ذخیره دچار مشکل شده است .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }

        $message['message'] = 'درخواست شما با موفقیت لغو شد . ';

        $message['class'] = '-primary';

        return redirect()->back()->with('message',$message);


    }

    public function showmyorders(Request $request,$id,$slug = ''){

        $activeMenu = '';
        
        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $getmyorder = ProductOrders::where('product_orders.po_id','=',$id)
        ->first();

        if(is_null($getmyorder)){

            $message['message'] = 'سفارش مورد نظر شما یافت نشد .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }
        
        
        $getdetialmyorder = ProductOrdersRelation::join('product_orders','product_orders_relation.por_po_id','=','product_orders.po_id')
        ->join('products','product_orders_relation.por_product_id','=','products.id')
        ->where('product_orders_relation.por_po_id','=',$id)
        ->where('product_orders.po_user_id','=',Auth::user()->id)
        ->where('product_orders.po_status','=',2)
        ->select('product_orders_relation.*','products.name','products.image_source')
        ->get();

        dd($getdetialmyorder);
        
        return view('mobile-view\dashboard\show-my-orders-detail')->with([

            'activeMenu' => $activeMenu,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'getproductcart' => $getproductcart,

        ]);

    }

    public function addtocart(Request $request,$id,$slug=''){

        
        $find = ProductPrices::where('product_prices.id','=',$id)
        ->first();
        
        
        if(is_null($find)){

            $message['message'] = 'محصول مورد نظر شما یافت نشد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }

        $duplicatecart = ProductCart::where('product_cart.pc_price_id','=',$find->id)
        ->where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','cart')
        ->first();


        if(!is_null($duplicatecart)){


            $message['message'] = 'این محصول در سبد خرید شما وجود دارد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }
        

        $addcart = new ProductCart();
        
        $addcart->pc_user_id = Auth::user()->id;

        $addcart->pc_price_id = $find->id;

        $addcart->pc_product_id = $find->price_pro_id;

        $addcart->pc_cart_type = 'cart';

        $saved = $addcart->save();

        if(!$saved){

            $message['message'] = 'متاسفانه محصول مورد نظر به سبد خرید اضافه نشد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        
        }

        $message['message'] = 'محصول مورد نظر به سبد خرید اضافه شد';

        $message['class'] = '-primary';

        return redirect()->back()->with('message',$message);
        
    }



    public function addtofav(Request $request,$id,$slug=''){

        
        $find = ProductPrices::where('product_prices.id','=',$id)
        ->first();
        
        
        if(is_null($find)){

            $message['message'] = 'محصول مورد نظر شما یافت نشد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }

        $duplicatecart = ProductCart::where('product_cart.pc_price_id','=',$find->id)
        ->where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','fav')
        ->first();


        if(!is_null($duplicatecart)){


            $message['message'] = 'این محصول در لیست علاقه مندی شما وجود دارد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }
        

        $addcart = new ProductCart();
        
        $addcart->pc_user_id = Auth::user()->id;

        $addcart->pc_price_id = $find->id;

        $addcart->pc_product_id = $find->price_pro_id;

        $addcart->pc_cart_type = 'fav';

        $saved = $addcart->save();

        if(!$saved){

            $message['message'] = 'متاسفانه محصول مورد نظر به لیست علاقه مندی شما اضافه نشد';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        
        }

        $message['message'] = 'محصول مورد نظر به لیست علاقه مندی شما اضافه شد';

        $message['class'] = '-primary';

        return redirect()->back()->with('message',$message);
        
    }
    

    public function showmyfav(){

        $activeMenu = '';
        
        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';


        $blogvieweds = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('blog_post.BP_VIEWED','>',25)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->select('blog_post.BP_TITLE','blog_files.bf_source')
            ->orderBy('blog_post.created_at','desc')
            ->take(8)
            ->get();

        
        
        $products = ProductCart::join('products','product_cart.pc_product_id','=','products.id')
        ->join('product_prices','product_cart.pc_price_id','product_prices.id')
        ->where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','fav')
        ->orderBy('product_cart.created_at','desc')
        ->select('products.name','products.image_source','products.slug','product_prices.*')
        ->paginate(10);
        
       

        return view('mobile-view\dashboard\show-my-favorites')->with([

            'activeMenu' => $activeMenu,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'blogvieweds' => $blogvieweds,

            'products' => $products


        ]);

    }

    public function delmyfav(Request $request,$id,$slug=''){

        $findmyfav = ProductCart::where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','fav')
        ->where('product_cart.pc_price_id','=',$id)
        ->first();


        if(is_null($findmyfav)){

            $message['message'] = 'متاسفانه محصول مورد علاقه شما یافت نشد .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        $delete = $findmyfav->delete();

        if(!$delete){

            $message['message'] = 'عملیات حذف با اشکال مواجه شد لطفا دوباره تلاش کنید .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        $message['message'] = 'محصول موردعلاقه شما با موفقیت حذف شد .';

        $message['class'] = '-primary';

        return redirect()->back()->with('message',$message);
    }


    public function showmycart(Request $request){

        $roles = [

            'discount' => 'required|string|min:10|max:10'

        ];

        $attributes = [

            'discount' => 'کد تخفیف'

        ];

        $messages = [

            
        ];

        if(!is_null($request->get('discount'))){

            $validate = Validator::make($request->all(),$roles,$messages,$attributes);
    	

            if($validate->fails()){

                $message['message'] = 'کد تخفیف وارد شده معتبر نمی باشد .';

                $message['class'] = '-danger';

                return redirect()->back()->withErrors($validate)->with('message',$message);

            }
        }

        

        
        $activeMenu = '';
        
        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $carts = ProductCart::join('products','product_cart.pc_product_id','=','products.id')
        ->join('product_prices','product_cart.pc_price_id','product_prices.id')
        ->where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','cart')
        ->orderBy('product_cart.created_at','desc')
        ->select('products.name','products.image_source','products.slug','products.product_weight','product_prices.*')
        ->get();

        if(is_null($carts)){

            $message['message'] = 'سبد خرید شما خالی است .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);
        }

        $totalamount = 0;

        $shippingcost = 0;

        $discountprice = 0;

        $discount = '';


        // calculate total amount & shipping cost
        foreach ($carts as $item){

            if($item->inventory > 0){

                if($item->amazing_status === 1){

                    $totalamount = $totalamount + $item->amazing_price;

                }elseif($item->discount_status === 1){

                    $totalamount = $totalamount + $item->discount_price;

                }elseif($item->amazing_status === 0 && $item->discount_status){

                    $totalamount = $totalamount + $item->price;
                }

                $shippingcost = $shippingcost + $item->product_weight;
            }
            
            
        }

        //shipping cost up 5000000 its free

        if($totalamount >= 5000000){

            $shippingcost = 0;
        }


        $shippingcost = $shippingcost * 45000;

        $amountpayable = $shippingcost + $totalamount;

        //calculate discount and roles

        if(!is_null($request->get('discount'))){
            
            $discount = $request->get('discount');

            $finddiscount = Discount::where('discount.discount_user_id','=',Auth::user()->id)
            ->where('discount.discount_code','=',$discount)
            ->where('discount.discount_status','=',0)
            ->where('discount.discount_type','=','product')
            ->first();

            if(!is_null($finddiscount)){

                $result = ($totalamount * 30) / (100) ;

                if($finddiscount->discount_price <= $result){

                    $discountprice = $finddiscount->discount_price;

                    $amountpayable = $amountpayable - $finddiscount->discount_price;

                }elseif($finddiscount->discount_price > $result){

                    $message['message'] = 'شما نمی توانید از این کد تخفیف برای سبد خرید خود استفاده نمایید ، کد تخفیف می تواند 30 درصد کل مبلغ خرید شما باشد .';

                    $message['class'] = '-danger';

                    return redirect()->back()->with('message',$message);
                }

                
            }
            else{

                $message['message'] = 'کد تخفیف وارد شده یافت نشد .';

                $message['class'] = '-danger';

                return redirect()->back()->with('message',$message);
            }
        }

        return view('mobile-view\dashboard\show-my-cart')->with([

            'activeMenu' => $activeMenu,

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'carts' => $carts,

            'totalamount' => $totalamount,

            'shippingcost' => $shippingcost,

            'amountpayable' => $amountpayable,

            'discountprice' => $discountprice,

            'discount' => $discount


        ]);

    }

    public function deleteproductcart(Request $request,$id,$slug=''){

        $findmycart = ProductCart::where('product_cart.pc_user_id','=',Auth::user()->id)
        ->where('product_cart.pc_cart_type','=','cart')
        ->where('product_cart.pc_price_id','=',$id)
        ->first();

        if(is_null($findmycart)){

            $message['message'] = 'متاسفانه محصول مورد نظر شما از سبد خرید حذف نشد .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        $delete = $findmycart->delete();

        if(!$delete){

            $message['message'] = 'عملیات حذف با اشکال مواجه شد لطفا دوباره تلاش کنید .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        $message['message'] = 'محصول مورد نظر شما از سبد خرید با موفقیت حذف شد .';

        $message['class'] = '-primary';

        return redirect()->back()->with('message',$message);
    }


    public function discountproductadd(Request $request){

        $roles = [

            'discount' => 'required|string|min:10|max:10'

        ];

        $attributes = [

            'discount' => 'کد تخفیف'

        ];

        $messages = [

            
        ];

        $validate = Validator::make($request->all(),$roles,$messages,$attributes);
    	

        if($validate->fails()){

            $message['message'] = 'کد تخفیف وارد شده معتبر نمی باشد .';

            $message['class'] = '-danger';

            return redirect()->back()->withErrors($validate)->with('message',$message);

        }

        $discount = $request->get('discount');

        $finddiscount = Discount::where('discount.discount_user_id','=',Auth::user()->id)
        ->where('discount.discount_code','=',$discount)
        ->where('discount.discount_status','=',0)
        ->where('discount.discount_type','=','product')
        ->first();

        if(is_null($finddiscount)){

            $message['message'] = 'کد تخفیف وارد شده یافت نشد .';

            $message['class'] = '-danger';

            return redirect()->back()->with('message',$message);

        }

        return redirect()->route('show_my_cart',[

            'discount' => $discount

        ]);

    }
    
}
