<?php

namespace App\Http\Controllers\mobileweb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductPrices;

class MainController extends Controller
{
    public function index(){

        $productcategoryparents = ProductCategory::where('parent','=','0')->get();
        
        $lastproducts = Products::join('product_images','products.id','=','product_images.pro_id')
            ->where('product_images.image_index','=','1')
            ->select('product_images.image_source','products.id','products.name','products.slug')
            ->orderBy('products.created_at','desc')
            ->take(6)
            ->get();
            
        foreach ($lastproducts as $index => $item){
        
            $lastproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS priceid','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->take(1)
                ->get();
 
        }

        
        $amazingproducts = ProductPrices::join('products','product_prices.price_pro_id','=','products.id')
        ->join('product_images','product_prices.price_pro_id','=','product_images.pro_id')
        ->select('product_prices.id as price_id','product_prices.price','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.warranty_name','product_prices.warranty_date','products.id','products.name','product_images.image_source','image_index')
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
        ->where('product_images.image_index','=','1')
        ->where('products.cat_id','=','9')
        ->select('product_images.image_source','products.id','products.name','products.slug')
        ->orderBy('products.created_at','desc')
        ->take(6)
        ->get();
        
    foreach ($laptopproducts as $index => $item){
    
        $laptopproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
            ->select('product_prices.price','product_prices.id AS priceid','product_prices.warranty_name','product_prices.warranty_date')
            ->orderBy('product_prices.price','asc')
            ->take(1)
            ->get();

    }

    $mobileproducts = Products::join('product_images','products.id','=','product_images.pro_id')
        ->where('product_images.image_index','=','1')
        ->where('products.cat_id','=','10')
        ->select('product_images.image_source','products.id','products.name','products.slug')
        ->orderBy('products.created_at','desc')
        ->take(6)
        ->get();
        
    foreach ($mobileproducts as $index => $item){
    
        $mobileproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
            ->select('product_prices.price','product_prices.id AS priceid','product_prices.warranty_name','product_prices.warranty_date')
            ->orderBy('product_prices.price','asc')
            ->take(1)
            ->get();

    }

    $modemproducts = Products::join('product_images','products.id','=','product_images.pro_id')
        ->where('product_images.image_index','=','1')
        ->where('products.cat_id','=','11')
        ->select('product_images.image_source','products.id','products.name','products.slug')
        ->orderBy('products.created_at','desc')
        ->take(6)
        ->get();
        
    foreach ($modemproducts as $index => $item){
    
        $modemproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
            ->select('product_prices.price','product_prices.id AS priceid','product_prices.warranty_name','product_prices.warranty_date')
            ->orderBy('product_prices.price','asc')
            ->take(1)
            ->get();

    }

        
        
        return view('/mobile-view/index')->with([

            'productcategoryparents'=> $productcategoryparents,

            'lastproducts' => $lastproducts,

            'amazingproducts' => $amazingproducts,

            'discountproducts' => $discountproducts,

            'laptopproducts' => $laptopproducts,

            'mobileproducts' => $mobileproducts,

            'modemproducts' => $modemproducts

        ]);
    }
}