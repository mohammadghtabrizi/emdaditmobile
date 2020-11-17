<?php

namespace App\Http\Controllers\mobileweb\product\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductPrices;
use App\Models\ProductBrands;
use App\Models\ProductColors;
use App\Models\ProductPropertyKey;
use App\Models\ProductPropertyValue;
use App\Models\ProductCart;

use App\Models\BlogPost;

use Cache;

use Auth;

class ProductMainController extends Controller
{
    public function showcategoryproduct(Request $request,$id,$slug = ''){

        $activeMenu = 'shop';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        $categories = $category = ProductCategory::where('product_category.parent','=',$id)
        ->select('product_category.id as category_id','product_category.name as category_name','product_category.slug as category_slug','product_category.image_source as category_image_source','product_category.meta_desc as category_meta_desc')
        ->get();

        foreach($categories as $index => $item){

            $categories[$index]['products'] = Products::where('products.cat_id','=',$item->category_id)
            ->select('products.id as product_id','products.name as product_name','products.slug as product_slug','products.image_source as images_image_source')
            ->orderBy('products.created_at','desc')
            ->take(6)
            ->get();

            foreach($item->products as $index2 => $products){
                
                $prices[$products->product_id][$products->product_id]['prices'] = ProductPrices::where('product_prices.price_pro_id','=',$products->product_id)
                    ->orderBy('product_prices.price','asc')
                    ->first();
            }
        }

        
        
        $blogvieweds = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('blog_post.BP_VIEWED','>',25)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->select('blog_post.BP_TITLE','blog_files.bf_source')
            ->orderBy('blog_post.created_at','desc')
            ->take(8)
            ->get();

        

        
        
        return view('/mobile-view/product-view/category-view')->with([


            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'activeMenu' => $activeMenu,

            'blogvieweds' => $blogvieweds,
            
            'categories' => $categories,
           
            'prices' => $prices,

            'category' => $category,

        ]);
    }

    public function showsubcategoryproduct(Request $request,$id,$slug = ''){
        
        $activeMenu = 'shop';

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

        $products = Products::join('product_category','products.cat_id','=','product_category.id')
        ->where('products.cat_id','=',$id)
        ->select('products.image_source','products.id','products.name','products.slug','product_category.name as category_name')
        ->orderBy('products.created_at','desc')
        ->paginate(6);
        
        foreach ($products as $index => $item){
    
            $products[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.discount_status','product_prices.discount_price','product_prices.discount_percent','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->first();

        }


        return view('/mobile-view/product-view/sub-category-view')->with([


            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'activeMenu' => $activeMenu,

            'blogvieweds' => $blogvieweds,

            'products' => $products
            
            

        ]);
    }

    public function showdetailproduct(Request $request,$id,$slug = ''){

        $activeMenu = 'shop';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';
        
        $idprice = $id;
        
        $idproduct = ProductPrices::select('product_prices.price_pro_id')
        ->where('id','=',$idprice)
        ->select('product_prices.price_pro_id')
        ->first();

        $idproduct = $idproduct->price_pro_id;
        
        $idcategory = Products::select('products.cat_id')
        ->where('products.id','=',$idproduct)
        ->select('products.cat_id')
        ->first();

        $idcategory = $idcategory->cat_id;

        $product = Products::where('products.id','=',$idproduct)->first();
        $category = ProductCategory::where('product_category.id','=',$idcategory)->get();
        $brand = ProductBrands::where('product_brands.cat_id','=',$idcategory)->get();
        $color = ProductColors::where('product_colors.product_price_id','=',$idprice)->orderBy('product_colors.price','asc')->get();
        $image = ProductImages::where('product_images.pro_id','=',$idproduct)->orderBy('product_images.image_index','desc')->get();
        $price = ProductPrices::where('product_prices.id','=',$idprice)->first();

        $moreprice = '';

        if($price->amazing_status === 0 && $price->discount_status === 0){

            $moreprice = ProductPrices::join('products','product_prices.price_pro_id','=','products.id')
                ->where('product_prices.price_pro_id','=',$idproduct)
                ->select('product_prices.*','products.slug')
                ->orderBy('product_prices.price','asc')
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

        $property = ProductPropertyKey::where('product_property_key.cat_id','=',$idcategory)
            ->where('product_property_key.parent','=',0)
            ->orderBy('product_property_key.levels','asc')
            ->get();

        foreach($property as $index => $item){
        $property[$index]['property'] = ProductPropertyValue::join('product_property_key','product_property_value.prop_id','=','product_property_key.id')
            ->where('product_property_value.product_id','=',$idproduct)
            ->where('product_property_key.parent','=',$item->id)
            ->select('product_property_value.id as value_id','product_property_value.prop_id','product_property_value.value','product_property_key.id as key_id','product_property_key.name','product_property_key.parent as key_parent')
            ->orderBy('product_property_key.levels','asc')
            ->get();
        
        }

        
        
            
        return view('/mobile-view/product-view/detail-product')->with([

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'activeMenu' => $activeMenu,

            'blogvieweds' => $blogvieweds,

            'product' => $product,

            'brand' => $brand,

            'category' => $category,

            'color' => $color,

            'image' => $image,

            'price' => $price,

            'property' => $property,

            'moreprice' => $moreprice

        ]);

    }

    public function searchproduct(Request $request){

        $activeMenu = 'shop';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';


        $searchproduct = $request->get('searchproduct');

        $products = Products::where('products.name','like','%'.$searchproduct.'%')
        ->select('products.image_source','products.id','products.name','products.slug')
        ->orderBy('products.created_at','desc')
        ->paginate(6);
        
        foreach ($products as $index => $item){
    
            $products[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->id)
                ->select('product_prices.price','product_prices.id AS price_id','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.discount_status','product_prices.discount_price','product_prices.discount_percent','product_prices.warranty_name','product_prices.warranty_date')
                ->orderBy('product_prices.price','asc')
                ->first();

        }
        
        $blogvieweds = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('blog_post.BP_VIEWED','>',25)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->select('blog_post.BP_TITLE','blog_files.bf_source')
            ->orderBy('blog_post.created_at','desc')
            ->take(8)
            ->get();


        return view('/mobile-view/product-view/search-product')->with([

            'metadescription' => $metadescription,

            'headertitle' => $headertitle,

            'activeMenu' => $activeMenu,

            'blogvieweds' => $blogvieweds,
            
            'products' => $products->appends($request->except('page'))

        ]);
    } 

    
}
    