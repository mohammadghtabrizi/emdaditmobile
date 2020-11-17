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

	// Comments

	Route::post('store_comment','mobileweb\blog\users\BlogMainController@addcomment')->name('store_comment');

});




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

		Route::post('/update_user_address','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@UpdateUserAddress')->name('update_user_address');

		/*Expert Request*/

		Route::get('/expertrequest','App\Http\Controllers\mobileweb\MainController@expertrequest')->name('expertrequest');

		Route::post('/store_expertrequest','App\Http\Controllers\mobileweb\MainController@addExpert')->name('store_expertrequest');

		Route::get('/request_history','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@requesthistory')->name('request_history_users');

		Route::get('/change_status_my_request/{id}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@changestatusrequest')->name('change_status_my_request');



		/* Product */

		Route::get('/show_my_orders/{id}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@showmyorders')->name('show_my_orders');

		Route::get('/show_my_favorites','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@showmyfav')->name('show_my_favorites');

		Route::get('/delete_my_favorite/{id}/{slug?}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@delmyfav')->name('delete_my_favorite');

		Route::get('/addcart/{id}/{slug?}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@addtocart')->name('add_to_cart');

		Route::get('/addfavorites/{id}/{slug?}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@addtofav')->name('add_to_favorites');

		Route::get('/my_cart','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@showmycart')->name('show_my_cart');

		Route::get('/delete_product_cart/{id}/{slug?}','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@deleteproductcart')->name('delete_product_cart');

		Route::post('/add_discount_product','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@discountproductadd')->name('add_discount_product');

		Route::post('/submit_my_order','App\Http\Controllers\mobileweb\Auth\Dashboard\MainDashboardController@submitmyorder')->name('submit_my_order');

		
		
	});

	

});