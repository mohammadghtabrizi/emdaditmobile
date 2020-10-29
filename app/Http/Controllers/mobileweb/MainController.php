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
}