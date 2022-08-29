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

Route::get('/','MainController@index')->name('user.main');

//** Product Route */
Route::get('single_product/{slug}','ProductController@show')->name('user.product');
Route::get('my_products','ProductController@user_products')->name('user.my_products');
Route::get('create_product',function (){
    return view('create_product');
})->name('user.form.product');
Route::post('create_product','ProductController@create')->name('user.create.product');

//** Offer Route */
Route::post('create_offer','OfferController@create')->name('user.create.offer');
Route::get('select_offer/{slug}/{offer_id}','OfferController@select_offer')->name('user.update.offer');
Route::get('my_offers','OfferController@my_offer')->name('user.my_offers');

//** Order Route */
Route::get('create_order/{offer_id}','OrderController@form')->name('user.form.order');

//** Checkout Route */
Route::post('bank','ShoppingController@create')->name('user.create.order');
Route::get('bank','ShoppingController@create')->name('bank');
Route::get('checkout/{ref_code}/{status}/{offer_id}/{order_id}','ShoppingController@checkout')->name('user.update.order');
Route::get('send_product/{order_id}','ShoppingController@send_product')->name('user.create.order.get');

//** Coupon Route */
Route::get('coupons','OfferPackageController@all')->name('user.offer_package');
Route::get('create_offer_pkg/{pkg_id}','UserOfferPkgController@create')->name('user.create.offerPkg');
Route::get('delete_user_offer_pkg/{pkg_id}','UserOfferPkgController@delete')->name('user.delete.userOfferPkg');
//** Cart Route */
Route::get('cart','ShoppingController@cart')->name('user.cart');


//** Login Route */
Route::get('login',function(){
    return view('login');
})->name('user.form.login');
Route::post('login','UserController@login')->name('user.login');
Route::get('logout','UserController@logout')->name('user.logout');
//** End Route */

//** Register Route */
Route::get('register',function (){
    return view('register');
})->name('user.form.register');
Route::post('register','UserController@create')->name('user.register');
//** End Route */

//** Admin Route */

Route::get('admin/login',function (){
    return view('admin.login');
})->name('admin.form.login');
Route::post('admin/login','AdminController@login')->name('admin.login');

Route::group(['prefix' => 'admin','middleware' => ['admin_auth']], function () {

    //** Dashboard Route */
    Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');

    //** Role Route */
    Route::get('roles','RoleController@roles')->name('admin.roles');
    Route::post('create_role','RoleController@store')->name('admin.create.role');
    //** End Route */

    //** Product Route **/
    Route::get('create_products',function(){
        return view('admin.create_product');
    })->name('admin.form.product');
    Route::post('create_product','ProductController@create')->name('admin.create.product');
    Route::get('products','ProductController@all')->name('admin.products');
    Route::get('remove_product/{id}','ProductController@remove')->name('admin.delete.product');
    //** End Route **/

    //** User Route */
    Route::get('create_user','UserController@form')->name('admin.form.user');
    Route::post('create_user','UserController@create')->name('admin.create.user');
    Route::get('users','UserController@users')->name('admin.users');
    Route::get('remove_user/{id}','UserController@remove')->name('admin.delete.user');
    //** End Route */

    //** Coupon Route */
    Route::get('create_offer_pkg',function (){
        return view('admin.create_offer_pkg');
    })->name('admin.form.offer_pkg');
    Route::post('create_offer_pkg','OfferPackageController@create')->name('admin.create.product');
    Route::get('offer_packages','OfferPackageController@all')->name('admin.offer_pkg');
    //** End Route */

});
