<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\PdfgenerateController;
use App\Http\Controllers\Front\FrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Frontend Routes */
Route::get('/',[FrontController::class,"index"]);
Route::get('/product/{slug}',[FrontController::class,"product"]);
Route::post('/add_to_cart',[FrontController::class, "add_to_cart"]);
Route::get('/cart',[FrontController::class, "cart"]);
Route::post('/update_cart_qty',[FrontController::class, "update_cart_qty"]);
Route::get('/category/{slug}',[FrontController::class, "category"]);
Route::get('/search/{string}',[FrontController::class, "search"]);

Route::group(['middleware'=>'register_auth'], function(){
    Route::get('/registration',[FrontController::class, "registration"]);
});
Route::post('/registration_process',[FrontController::class, "registration_process"]);
Route::post('/login_process',[FrontController::class, "login_process"]);


Route::post('/reset_password_process',[FrontController::class, "reset_password_process"]);
Route::get('/reset_password/{id}',[FrontController::class, "reset_password_form"]);
Route::post('/forgot_password_process',[FrontController::class, "forgot_password_process"]);
Route::get('/checkout',[FrontController::class, "checkout"])->name('checkout');
Route::post('/apply_coupon_code',[FrontController::class, "apply_coupon_code"]);
Route::post('/place_order',[FrontController::class, "place_order"]);
Route::get('/order_placed',[FrontController::class, "order_placed"])->name('order_placed');
Route::get('/order_gateway_placed/{order_id}',[FrontController::class, "order_gateway_placed"])->name('order_gateway_placed');
Route::get('/reffer_friend',[FrontController::class, "reffer_friend"]);
Route::post('/reffer_friend_process',[FrontController::class, "reffer_friend_process"])->name('reffer_friend_process');




Route::get('/logout', function(){
    if(session()->has('FRONT_CUSTOMER_ID'))
    {
        session()->forget('FRONT_CUSTOMER_ID');
        session()->forget('FRONT_CUSTOMER_NAME');
        session()->forget('CART_USER_LOGIN');
        session()->forget('USER_TEMP_ID');
        return redirect('/');
    }
});
Route::get('/verification/{id}',[FrontController::class, "customer_verification"]);



/* Backend Routes */
Route::get('/admin',[AdminController::class,"index"]);
Route::post('/admin/auth',[AdminController::class, "auth"])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('/admin/logout',[AdminController::class, "logout"]);
    Route::get('/admin/dashboard',[AdminController::class, "dashboard"]);

    /*---------------- Category Routes Start ----------------*/
    Route::get('/admin/category',[CategoryController::class, "index"]);
    Route::get('/admin/category/manage_category',[CategoryController::class, "manage_category"]);
    Route::get('/admin/category/manage_category/{id}',[CategoryController::class, "manage_category"]);
    Route::post('/admin/category/manage_category_process',[CategoryController::class, "manage_category_process"])->name('category.process');
    Route::get('/admin/category/status/{status}/{id}',[CategoryController::class, "category_status"])->name('category.status');
    Route::get('/admin/category/delete/{id}',[CategoryController::class, "delete_category"])->name('category.delete');
    /*---------------- Category Routes End ----------------*/

    /*---------------- Coupon Routes Start ----------------*/
    Route::get('/admin/coupon',[CouponController::class, "index"]);
    Route::get('/admin/coupon/manage_coupon',[CouponController::class, "manage_coupon"]);
    Route::get('/admin/coupon/manage_coupon/{id}',[CouponController::class, "manage_coupon"]);
    Route::post('/admin/coupon/manage_coupon_process',[CouponController::class, "manage_coupon_process"])->name('coupon.process');
    Route::get('/admin/coupon/delete/{id}',[CouponController::class, "delete_coupon"])->name('coupon.delete');
    /*---------------- Coupon Routes End ----------------*/

    /*---------------- Size Routes Start ----------------*/
    Route::get('/admin/size',[SizeController::class, "index"]);
    Route::get('/admin/size/manage_size',[SizeController::class, "manage_size"]);
    Route::get('/admin/size/manage_size/{id}',[SizeController::class, "manage_size"]);
    Route::post('/admin/size/manage_size_process',[SizeController::class, "manage_size_process"])->name('size.process');
    Route::get('/admin/size/status/{status}/{id}',[SizeController::class, "size_status"])->name('size.status');
    Route::get('/admin/size/delete/{id}',[SizeController::class, "delete_size"])->name('size.delete');
    /*---------------- Size Routes End ----------------*/

    /*---------------- Colour Routes Start ----------------*/
    Route::get('/admin/colour',[ColorController::class, "index"]);
    Route::get('/admin/colour/manage_colour',[ColorController::class, "manage_colour"]);
    Route::get('/admin/colour/manage_colour/{id}',[ColorController::class, "manage_colour"]);
    Route::post('/admin/colour/manage_colour_process',[ColorController::class, "manage_colour_process"])->name('colour.process');
    Route::get('/admin/colour/status/{status}/{id}',[ColorController::class, "colour_status"])->name('colour.status');
    Route::get('/admin/colour/delete/{id}',[ColorController::class, "delete_colour"])->name('colour.delete');
    /*---------------- Colour Routes End ----------------*/

    /*---------------- Product Routes Start ----------------*/
    Route::get('/admin/product',[ProductController::class, "index"]);
    Route::get('/admin/product/manage_product',[ProductController::class, "manage_product"]);
    Route::get('/admin/product/manage_product/{id}',[ProductController::class, "manage_product"]);
    Route::post('/admin/product/manage_product_process',[ProductController::class, "manage_product_process"])->name('product.process');
    Route::get('/admin/product/status/{status}/{id}',[ProductController::class, "product_status"])->name('product.status');
    Route::get('/admin/product/delete/{id}',[ProductController::class, "delete_product"])->name('product.delete');
    Route::get('/admin/product/delete_attribute/{pid}/{paid}',[ProductController::class, "delete_attribute"]);
    Route::get('/admin/product/delete_gallery/{pid}/{piid}/{gallery_image}',[ProductController::class, "delete_gallery_image"]);
    /*---------------- Product Routes End ----------------*/

    /*---------------- Brand Routes Start ----------------*/
    Route::get('/admin/brand',[BrandController::class, "index"]);
    Route::get('/admin/brand/manage_brand',[BrandController::class, "manage_brand"]);
    Route::get('/admin/brand/manage_brand/{id}',[BrandController::class, "manage_brand"]);
    Route::post('/admin/brand/manage_brand_process',[BrandController::class, "manage_brand_process"])->name('brand.process');
    Route::get('/admin/brand/status/{status}/{id}',[BrandController::class, "brand_status"])->name('brand.status');
    Route::get('/admin/brand/delete/{id}',[BrandController::class, "delete_brand"])->name('brand.delete');
    /*---------------- Brand Routes End ----------------*/

    /*---------------- Tax Routes Start ----------------*/
    Route::get('/admin/tax',[TaxController::class, "index"]);
    Route::get('/admin/tax/manage_tax',[TaxController::class, "manage_tax"]);
    Route::get('/admin/tax/manage_tax/{id}',[TaxController::class, "manage_tax"]);
    Route::post('/admin/tax/manage_tax_process',[TaxController::class, "manage_tax_process"])->name('tax.process');
    Route::get('/admin/tax/status/{status}/{id}',[TaxController::class, "tax_status"])->name('tax.status');
    Route::get('/admin/tax/delete/{id}',[TaxController::class, "delete_tax"])->name('tax.delete');
    /*---------------- Tax Routes End ----------------*/

    /*---------------- Customer Routes Start ----------------*/
    Route::get('/admin/customer',[CustomerController::class, "index"]);
    Route::get('/admin/customer/status/{status}/{id}',[CustomerController::class, "customer_status"])->name('customer.status');
    /*---------------- Customer Routes End ----------------*/

    /*---------------- Banner Routes Start ----------------*/
    Route::get('/admin/banner',[HomeBannerController::class, "index"]);
    Route::get('/admin/banner/manage_banner',[HomeBannerController::class, "manage_banner"]);
    Route::get('/admin/banner/manage_banner/{id}',[HomeBannerController::class, "manage_banner"]);
    Route::post('/admin/banner/manage_banner_process',[HomeBannerController::class, "manage_banner_process"])->name('banner.process');
    Route::get('/admin/banner/status/{status}/{id}',[HomeBannerController::class, "banner_status"])->name('banner.status');
    Route::get('/admin/banner/delete/{id}',[HomeBannerController::class, "delete_banner"])->name('banner.delete');
    /*---------------- Banner Routes End ----------------*/
    Route::get('admin/pdf/generate', [PdfgenerateController::class, "generate_pdf"]);
    Route::get('admin/pdf/download/{id}', [PdfgenerateController::class, "download_pdf"]);

    

});