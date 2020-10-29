<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Index Route

Route::get('/', 'App\Http\Controllers\mobileweb\MainController@index')->name('index');


// Products 

Route::group(['prefix' => 'products'],function(){

	Route::get('/category/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showcategoryproduct')->name('show_category_product');

	Route::get('/subcategory/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showsubcategoryproduct')->name('show_sub_category_product');

	Route::get('/search','App\Http\Controllers\mobileweb\product\users\ProductMainController@searchproduct')->name('search_product');

	Route::get('/detail/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showdetailproduct')->name('show_detail_product');


});

// Blog 

Route::group(['prefix' => 'blog'],function(){

	Route::get('/','mobileweb\blog\users\BlogMainController@indexblog')->name('blog_main');

	Route::get('/post/{id}/{slug?}','mobileweb\blog\users\BlogMainController@postshow')->name('show_post');

	Route::get('/category/{id}/{slug?}','mobileweb\blog\users\BlogMainController@category')->name('list_category_posts');

	Route::post('/','mobileweb\blog\users\BlogMainController@blogsearch')->name('blog_search');

	Route::post('/addcomment','mobileweb\blog\users\BlogMainController@addComment')->name('store_comment');

	Route::post('/addreplycomment','mobileweb\blog\users\BlogMainController@addreplycomment')->name('add_reply_comment');

});

// Comments

Route::post('store_comment','mobileweb\blog\users\BlogMainController@addcomment')->name('store_comment');
