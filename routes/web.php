<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Mail;



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

// ====================== Product ======================= //
Route::get('/product',[EcommerceController::class,'Product'])->name('product')->middleware('checkLogin');

Route::post('/products_store',[EcommerceController::class,'Product_Store'])->name('products_store');

Route::get('/record_product',[EcommerceController::class,'Product_List'])->name('record_product')->middleware('checkLogin');

Route::get('/view_product{id}',[EcommerceController::class,'View_Product'])->name('view_product')->middleware('checkLogin');

Route::get('/update_product/{id}',[EcommerceController::class,'Update_Product'])->name('update_product')->middleware('checkLogin');

Route::post('/products_update/{id}',[EcommerceController::class,'Update_Product_Store'])->name('products_update');

Route::get('/delete_product/{id}',[EcommerceController::class,'Delete_Product'])->name('delete_product')->middleware('checkLogin');

// ================= Earning ============================== //
Route::get('/earning',[EcommerceController::class,'MyEarnings'])->name('earning')->middleware('checkLogin');

// ================== Seller Notification ================ //
Route::get('/seller_notification',[EcommerceController::class,'SellerNotifications'])->name('seller_notification')->middleware('checkLogin');;

// ================= Login & Register ====================== //
Route::get('/register',[EcommerceController::class,'Register'])->name('register')->middleware('guestCheck');

Route::post('/register_form',[EcommerceController::class,'Register_Form'])->name('register_form');

Route::get('/',[EcommerceController::class,'Login'])->name('login')->middleware('guestCheck');

Route::post('/login_form',[EcommerceController::class,'Login_Form'])->name('login_form');

Route::post('/logout',[EcommerceController::class,'Logout'])->name('logout');

Route::get('/forget_password',[EcommerceController::class,'Forget_Password'])->name('forget_password');

Route::post('/forgot_password_send',[EcommerceController::class,'SendResetLink'])->name('forgot_password_send');

Route::get('/reset-password/{token}',[EcommerceController::class,'ResetPassword'])->name('reset-password');

Route::post('/reset_password_update',[EcommerceController::class,'UpdatePassword'])->name('reset_password_update');


Route::get('/test-mail', function () {
    Mail::raw('Mailtrap test successful!', function ($message) {
        $message->to('test@example.com')
                ->subject('Mailtrap Test');
    });
    return 'Mail sent';
});

Route::get('/mail-debug', function () {
    return config('mail.mailers.smtp');
});

// ================== Admin Dashboard ======================= //
Route::get('/admin',[EcommerceController::class,'Dashboard'])->name('admin')->middleware('adminDashboard');

Route::get('/admin_order',[EcommerceController::class,'AdminOrder'])->name('admin_order')->middleware('adminDashboard');

Route::get('/record_customer',[EcommerceController::class,'Customer'])->name('record_customer')->middleware('adminDashboard');

Route::get('/delete_customer/{id}',[EcommerceController::class,'Delete_Customer'])->name('delete_customer')->middleware('adminDashboard');

Route::get('/order_detail/{id}',[EcommerceController::class,'OrderDetail'])->name('order_detail')->middleware('adminDashboard');

Route::get('/seller_order',[EcommerceController::class,'SellerOrder'])->name('seller_order')->middleware('adminDashboard');

Route::get('/seller',[EcommerceController::class,'ViewSellers'])->name('seller')->middleware('adminDashboard');

Route::post('/admin_seller/{id}',[EcommerceController::class,'Make_Admin'])->name('admin_seller');

Route::post('/admin_seller_disable/{id}',[EcommerceController::class,'DisableSeller'])->name('admin_seller_disable');

Route::post('admin_seller_enable/{id}',[EcommerceController::class,'EnableSeller'])->name('admin_seller_enable');

// ================== Cart Product ======================== // 
Route::get('/index',[customerController::class,'Index'])->name('index');

Route::post('/products_cart_store',[customerController::class,'AddCart'])->name('products_cart_store');

Route::get('/view_cart',[customerController::class,'ViewCart'])->name('view_cart');

Route::post('/cart_update/{key}',[customerController::class,'CartUpdate'])->name('cart_update');

Route::post('/cart_delete/{key}',[customerController::class,'CartDelete'])->name('cart_delete');

Route::post('/cart_delete_all',[customerController::class,'DeleteAllCart'])->name('cart_delete_all');

Route::get('/view_product_cart/{id}',[customerController::class,'ViewProductCart'])->name('view_product_cart');

// ============== Order Confirm  ================ //
Route::get('/confirm_order',[OrderController::class,'ConfirmForm'])->name('confirm_order');

Route::post('/place_order',[OrderController::class,'Place_Order'])->name('place_order');

Route::get('/order/success', [OrderController::class, 'OrderSuccess'])->name('order.success');

Route::post('/order/send-otp', [OrderController::class, 'sendOtp'])->name('order.sendOtp');

Route::post('/order/verify-otp', [OrderController::class, 'verifyOtp'])->name('order.verifyOtp');


Route::get('/test-mail', function () {
    $order = \App\Models\Order::latest()->first();
    $items = \App\Models\OrderItem::where('order_id', $order->id)->get();
    $customer = \App\Models\Customer::find($order->customer_id);

    try {
        \Mail::to($customer->email)->send(new \App\Mail\OrderConfirmMail($order, $items));
        return 'Mail sent!';
    } catch (\Exception $e) {
        return 'Mail failed: ' . $e->getMessage();
    }
});