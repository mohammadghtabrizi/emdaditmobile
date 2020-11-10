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


/*Expert Request*/
Route::group(['prefix' => '/','middleware' => ['App\Http\Middleware\userIsAuth']],function(){

	Route::get('expertrequest','App\Http\Controllers\mobileweb\MainController@expertrequest')->name('expertrequest');

	Route::post('store_expertrequest','App\Http\Controllers\mobileweb\MainController@addExpert')->name('store_expertrequest');
});

// Products 

Route::group(['prefix' => 'products'],function(){

	Route::get('/category/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showcategoryproduct')->name('show_category_product');

	Route::get('/subcategory/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showsubcategoryproduct')->name('show_sub_category_product');

	Route::get('/search','App\Http\Controllers\mobileweb\product\users\ProductMainController@searchproduct')->name('search_product');

	Route::get('/detail/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@showdetailproduct')->name('show_detail_product');

	Route::get('/addcart/{id}/{slug?}','App\Http\Controllers\mobileweb\product\users\ProductMainController@addtocart')->name('add_to_cart');


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


// Auth
Route::group(['prefix' => 'auth'],function(){

	Route::post('/login','App\Http\Controllers\mobileweb\Auth\LoginController@login')->name('login_front_end_user');

	Route::get('/login','App\Http\Controllers\mobileweb\Auth\LoginController@index')->name('login_front_end_user_view');
	
	Route::get('/verification','App\Http\Controllers\mobileweb\Auth\LoginController@userverificationview')->name('verification_user_view');

	Route::post('/verification','App\Http\Controllers\mobileweb\Auth\LoginController@userverification')->name('verification_user');

	Route::get('/logout','App\Http\Controllers\mobileweb\Auth\LogoutController@Logout')->name('logout_front_end_user');

	Route::get('/register','App\Http\Controllers\mobileweb\Auth\RegisterController@registerview')->name('register_view_user');

	Route::post('/register','App\Http\Controllers\mobileweb\Auth\RegisterController@registeradd')->name('register_add_user');

	

});

//Dashboard
Route::group(['prefix' => 'dashboard'],function(){

	Route::group(['prefix' => '/','middleware' => ['App\Http\Middleware\userIsAuth']],function(){

		Route::get('/','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@Homeprofile')->name('dashboard_users');

		Route::post('/update_user_profile','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@UpdateUserProfile')->name('update_user_profile');

		Route::get('/my_request','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@showmyrequest')->name('show_my_request');

		Route::get('/my_address','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@showmyaddress')->name('show_my_address');

		Route::post('/update_user_address','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@UpdateUserAddress')->name('update_user_address');


		
		
	});

	

});