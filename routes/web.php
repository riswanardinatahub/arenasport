<?php

use Illuminate\Support\Facades\DB;
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

Route::post('autoLogin','AuthController@autoLogin');

Route::get('/coba', function(){
   return DB::table('regencies')->where('province_id',31)->get();
});

Route::get('/kamu', 'HomeController@kamu');
Route::get('/registerpartner', 'HomeController@registerpartner')->name('registerpartner');
Route::get('/', 'HomeController@index')->name('home');
Route::post('/filterdata', 'HomeController@filterdata')->name('filterdata');

Route::get('/rank', 'HomeController@rank')->name('rank');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::get('/tambahqty/{id}', 'DetailController@tambahqty')->name('tambahqty');
Route::get('/kurangqty/{id}', 'DetailController@kurangqty')->name('kurangqty');




Route::get('/stores', 'StoreController@index')->name('store-page-search');
Route::get('/stores/{id}', 'StoreController@area')->name('store-page-area');
Route::get('/store/detail/{id}', 'StoreController@detail')->name('store-page-detail');



Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');




Route::group(['middleware' => ['auth']], function(){

Route::get('/cart', 'CartController@index')->name('cart');
Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

Route::post('/checkout', 'CheckoutController@process')->name('checkout');
Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');



Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');

Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');


Route::get('/konfirmasistatuscustomer/{id}', 'DashboardTransactionController@konfirmasistatuscustomer')->name('konfirmasistatuscustomer');
Route::get('/konfirmasistatuspenjual/{id}', 'DashboardTransactionController@konfirmasistatuspenjual')->name('konfirmasistatuspenjual');



Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');





});


Route::prefix('admin')
->namespace('Admin')
->middleware(['auth','admin'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('admin-store-user', 'AdminStoreController');
    Route::resource('product', 'ProductController');
    Route::get('/admin/pending', 'ProductController@pending')->name('admin-product-pending');
    Route::get('/admin/terima/{id}', 'ProductController@terima')->name('admin-product-terima');
    Route::get('/admin/tolak/{id}', 'ProductController@tolak')->name('admin-product-tolak');
    Route::resource('transaction', 'TransactionController');
    Route::resource('product-gallery', 'ProductGalleryController');
    Route::get('delete/{id}','UserController@destroy')->name('delete-user');
});



Route::prefix('adminstore')
->namespace('AdminStore')
->middleware(['auth','adminstore'])
->group(function() {
    Route::get('/', 'DashboardController@index')->name('admin-store-dashboard');
    Route::resource('adminstore-category', 'CategoryController');
    Route::resource('adminstore-user', 'UserController');
    Route::get('/adminstore/user/tambahdata', 'UserController@create')->name('tambahdata');
    Route::post('/adminstore/user/add', 'UserController@store')->name('adddata');

    
    Route::resource('adminstore-product', 'ProductController');
    Route::get('/adminstore/pending', 'ProductController@pending')->name('adminstore-product-pending');
    Route::get('/adminstore/terima/{id}', 'ProductController@terima')->name('adminstore-product-terima');
    Route::get('/adminstore/tolak/{id}', 'ProductController@tolak')->name('adminstore-product-tolak');


    Route::get('/adminstore/tambahproduk', 'ProductController@create')->name('tambahproduk');
    Route::post('/adminstore/tambahproduk/add', 'ProductController@store')->name('addproduk');
    Route::get('/adminstore/editproduk/{id}', 'ProductController@edit')->name('editproduk');
    Route::post('/adminstore/updateproduk/{id}', 'ProductController@update')->name('updateproduk');

    Route::resource('adminstore-transaction', 'TransactionController');
    Route::resource('adminstore-product-gallery', 'ProductGalleryController');
    

    
});




Auth::routes();

