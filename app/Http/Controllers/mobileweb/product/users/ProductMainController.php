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

use App\Models\BlogPost;

class ProductMainController extends Controller
{
    public function showcategoryproduct(Request $request,$id,$slug = ''){

        $activeMenu = 'shop';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';

        // $showcategoryproducts = ProductCategory::where('product_category.parent','=',$id)
        // ->select('product_category.id as category_id','product_category.name as category_name','product_category.slug','product_category.image_source')
        // ->get();

        // $showcategoryproduct = $showcategoryproducts;
        
        // foreach($showcategoryproducts as $index => $itemproduct){
            
        //     $showcategoryproducts[$index]['products'] = Products::join('product_images','products.id','=','product_images.pro_id')
        //     ->join('product_prices','products.id','=','product_prices.price_pro_id')
            
        //     ->where('product_images.image_index','=','1')
        //     ->where('products.cat_id','=',$itemproduct->category_id)
        //     ->orderBy('products.created_at','desc')
        //     ->orderBy('product_prices.price','asc')
            
        //     ->select('products.id as product_id','products.name as product_name','products.slug as product_slug','product_images.image_source','product_prices.id as prices_id','product_prices.price','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.discount_status','product_prices.discount_price','product_prices.discount_percent','product_prices.warranty_name','product_prices.warranty_date')
            
        //     ->take(8)
        //     ->get();

        
        
       
        // }
        // dd($showcategoryproducts);
        // foreach($itemproduct->products as $index => $item){
            
        //     $showcategoryproducts[$index]['price'] = ProductPrices::where('product_prices.price_pro_id','=',$item->product_id)
        //     ->select('product_prices.id as prices_id','product_prices.price','product_prices.amazing_status','product_prices.amazing_price','product_prices.amazing_percent','product_prices.discount_status','product_prices.discount_price','product_prices.discount_percent','product_prices.warranty_name','product_prices.warranty_date')
        //     ->orderBy('product_prices.price','asc')
        //     ->first()
        //     ->get();

            
            
        // }
        
        
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

            'showcategoryproduct' => $showcategoryproduct,

            'showcategoryproducts' => $showcategoryproducts,

            'blogvieweds' => $blogvieweds,

            'slug' => $slug

        ]);
    }

    public function showdetailproduct(Request $request,$id,$slug = ''){

        $activeMenu = 'shop';

        $metadescription = 'فروش و تعمیرات تخصصی ماشین های اداری،فروش انواع کامپیوتر و لپ تاپ ، تعمیرات لپ تاپ ، تعمیرات پرینتر ، درخواست کارشناس ، تعمیرات چاپگر ، تعمیر کامپیوتر ، شارژ کارتریج ';

        $headertitle = 'امداد آی تی | EmdadIT Co.';
        
        $idprice = $id;
        
        $idproduct = ProductPrices::select('product_prices.price_pro_id')
        ->where('id','=',$idprice)
        ->get();

        $idproduct = $idproduct->first()->price_pro_id;
        
        $idcategory = Products::select('products.cat_id')
        ->where('products.id','=',$idproduct)
        ->get();

        $idcategory = $idcategory->first()->cat_id;

        $product = Products::where('products.id','=',$idproduct)->get();
        $category = ProductCategory::where('product_category.id','=',$idcategory)->get();
        $brand = ProductBrands::where('product_brands.cat_id','=',$idcategory)->get();
        $color = ProductColors::where('product_colors.product_price_id','=',$idprice)->orderBy('product_colors.price','asc')->get();
        $image = ProductImages::where('product_images.pro_id','=',$idproduct)->orderBy('product_images.image_index','desc')->get();
        $price = ProductPrices::where('product_prices.id','=',$idprice)->get();

        if($product->first()->amazing_status === 0 && $product->first()->discount_status === 0){

            
        }
        

        

        
        $blogvieweds = BlogPost::join('blog_files','blog_post.id','=','blog_files.bf_idpost')
            ->where('blog_files.bf_default','=',1)
            ->where('blog_post.BP_VIEWED','>',25)
            ->where('blog_post.BP_DISPLAYSTATUS','=',1)
            ->select('blog_post.BP_TITLE','blog_files.bf_source')
            ->orderBy('blog_post.created_at','desc')
            ->take(8)
            ->get();
    
        $property = ProductPropertyValue::join('product_property_key','product_property_value.prop_id','=','product_property_key.id')
        ->where('product_property_value.product_id','=',$idproduct)
        ->select('product_property_value.id as value_id','product_property_value.prop_id','product_property_value.value','product_property_key.id as key_id','product_property_key.name','product_property_key.parent as key_parent')
        ->orderBy('product_property_key.levels','asc')
        ->get();

        $propertykeyparents = ProductPropertyKey::where('product_property_key.cat_id','=',$idcategory)
        ->where('product_property_key.parent','=',0)
        ->orderBy('product_property_key.levels','asc')
        ->get();
        
        
        
            
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

            'propertykeyparents' => $propertykeyparents

        ]);

    }
}
    