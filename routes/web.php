<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CounterLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VatController;
use App\Http\Controllers\TotalTableController;
use App\Http\Controllers\TotalWaiterController;
use App\Http\Controllers\CollectOrderController;
use App\Http\Controllers\TotalOrderController;

use App\Http\Controllers\KitchenLoginController;
use App\Http\Controllers\KitchenTotalOrderController;

use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerCollectOrderController;
use App\Http\Controllers\CustomerTotalOrderController;

use App\Http\Controllers\WaiterLoginController;
use App\Http\Controllers\WaiterPaindingOrderController;
use App\Http\Controllers\WaiterTotalOrderController;


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

Route::get('/', function () {
    return view('/login');
});

//Counter Start
Route::get('/counter',[CounterLoginController::class,'index']);
Route::get('/counter/login',[CounterLoginController::class,'index']);
Route::post('/counter/auth',[CounterLoginController::class,'auth'])->name('counter.auth');

Route::group(['middleware'=>'counter_auth'],function(){
    Route::get('/counter/logout', function () {
        session()->forget('COUNTER_LOGIN');
        session()->forget('COUNTER_ID');
        session()->flash('msg','Logout Successfully');
        return redirect('/counter');
    });

    //Route::get('/counter/updatepassword',[CounterLoginController::class,'updatepassword']);
    Route::get('/counter/dashboard',[CounterLoginController::class,'dashboard']);

    //Category
    Route::get('/counter/category',[CategoryController::class,'index']);
    Route::get('/counter/category/manage_category',[CategoryController::class,'manage_category']);
    Route::get('/counter/category/status/{status}/{id}',[CategoryController::class,'status']);
    Route::post('/counter/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('/counter/category/manage_category/{id}',[CategoryController::class,'manage_category']);
    Route::get('/counter/category/delete/{id}',[CategoryController::class,'destroy']);

    //size
    Route::get('/counter/size',[SizeController::class,'index']);
    Route::get('/counter/size/manage_size',[SizeController::class,'manage_size']);
    Route::get('/counter/size/status/{status}/{id}',[SizeController::class,'status']);
    Route::post('/counter/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');
    Route::get('/counter/size/manage_size/{id}',[SizeController::class,'manage_size']);
    Route::get('/counter/size/delete/{id}',[SizeController::class,'destroy']);

    //type
    Route::get('/counter/type',[TypeController::class,'index']);
    Route::get('/counter/type/manage_type',[TypeController::class,'manage_type']);
    Route::get('/counter/type/status/{status}/{id}',[TypeController::class,'status']);
    Route::post('/counter/type/manage_type_process',[TypeController::class,'manage_type_process'])->name('type.manage_type_process');
    Route::get('/counter/type/manage_type/{id}',[TypeController::class,'manage_type']);
    Route::get('/counter/type/delete/{id}',[TypeController::class,'destroy']);

    //Item
    Route::get('/counter/item',[ItemController::class,'index']);
    Route::get('/counter/item/manage_item',[ItemController::class,'manage_item']);
    Route::get('/counter/item/manage_item/{id}',[ItemController::class,'manage_item']);
    Route::get('/counter/item/status/{status}/{id}',[ItemController::class,'status']);
    Route::post('/counter/item/manage_item_process',[ItemController::class,'manage_item_process'])->name('item.manage_item_process');
    Route::get('/counter/item/delete/{id}',[ItemController::class,'destroy']);
    Route::get('/counter/item/item_attr_delete/{itaid}/{id}',[ItemController::class,'item_attr_delete']);

    //VAT
    Route::get('/counter/vat',[VatController::class,'index']);
    Route::get('/counter/vat/manage_vat',[VatController::class,'manage_vat']);
    Route::get('/counter/vat/status/{status}/{id}',[VatController::class,'status']);
    Route::post('/counter/vat/manage_vat_process',[VatController::class,'manage_vat_process'])->name('vat.manage_vat_process');
    Route::get('/counter/vat/manage_vat/{id}',[VatController::class,'manage_vat']);
    Route::get('/counter/vat/delete/{id}',[VatController::class,'destroy']);

    //Table
    Route::get('/counter/table',[TotalTableController::class,'index']);
    Route::get('/counter/table/manage_table',[TotalTableController::class,'manage_table']);
    Route::get('/counter/table/status/{status}/{id}',[TotalTableController::class,'status']);
    Route::post('/counter/table/manage_table_process',[TotalTableController::class,'manage_table_process'])->name('table.manage_table_process');
    Route::get('/counter/table/manage_table/{id}',[TotalTableController::class,'manage_table']);
    Route::get('/counter/table/delete/{id}',[TotalTableController::class,'destroy']);

    //Waiter
    Route::get('/counter/waiter',[TotalWaiterController::class,'index']);
    Route::get('/counter/waiter/manage_waiter',[TotalWaiterController::class,'manage_waiter']);
    Route::get('/counter/waiter/status/{status}/{id}',[TotalWaiterController::class,'status']);
    Route::post('/counter/waiter/manage_waiter_process',[TotalWaiterController::class,'manage_waiter_process'])->name('waiter.manage_waiter_process');
    Route::get('/counter/waiter/manage_waiter/{id}',[TotalWaiterController::class,'manage_waiter']);
    Route::get('/counter/waiter/delete/{id}',[TotalWaiterController::class,'destroy']);

    //Coupon
    Route::get('/counter/coupon',[CouponController::class,'index']);
    Route::get('/counter/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
    Route::get('/counter/coupon/status/{status}/{id}',[CouponController::class,'status']);
    Route::post('/counter/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process');
    Route::get('/counter/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon']);
    Route::get('/counter/coupon/delete/{id}',[CouponController::class,'destroy']);

    //Collect Order
    Route::get('/counter/collect_order',[CollectOrderController::class,'index']);
    Route::get('/counter/collect_order/{id}',[CollectOrderController::class,'get_category_data']);
    Route::get('/counter/cart/{id}',[CollectOrderController::class,'cart_data']);
    Route::get('/counter/cart_update/{id}',[CollectOrderController::class,'cart_data_update']);
    Route::get('/counter/cart_delete/{id}',[CollectOrderController::class,'cart_data_dalete']);
    Route::get('/counter/collect_order/manage_collect_order',[CollectOrderController::class,'manage_collect_order']);
    Route::get('/counter/collect_order/status/{status}/{id}',[CollectOrderController::class,'status']);
    Route::post('/counter/collect_order/manage_collect_order_process',[CollectOrderController::class,'manage_collect_order_process'])->name('collect_order.manage_collect_order_process');
    Route::get('/counter/collect_order/manage_collect_order/{id}',[CollectOrderController::class,'manage_collect_order']);
    Route::get('/counter/collect_order/delete/{id}',[CollectOrderController::class,'destroy']);
    Route::post('/counter/order',[CollectOrderController::class,'order'])->name('counter.order');

    //Total Order
    Route::get('/counter/totalorder',[TotalOrderController::class,'index']);
    Route::get('/counter/order_details/{id}',[TotalOrderController::class,'orderDetails']);
    Route::get('/counter/order_status_update/{id}',[TotalOrderController::class,'order_status_update']);
    Route::get('/counter/totalorder/manage_total_order/{id}',[TotalOrderController::class,'manage_total_order']);
    Route::post('/counter/totalorder/manage_total_order_process',[TotalOrderController::class,'manage_total_order_process'])->name('totalorder.manage_total_order_process');
});
//Counter End


//Kitchen Start
Route::get('/kitchen',[KitchenLoginController::class,'index']);
Route::get('/kitchen/login',[KitchenLoginController::class,'index']);
Route::post('/kitchen/auth',[KitchenLoginController::class,'auth'])->name('kitchen.auth');

Route::group(['middleware'=>'kitchen_auth'],function(){
    Route::get('/kitchen/logout', function () {
        session()->forget('KITCHEN_LOGIN');
        session()->forget('KITCHEN_ID');
        session()->flash('msg','Logout Successfully');
        return redirect('/kitchen');
    });

    Route::get('/kitchen/dashboard',[KitchenLoginController::class,'dashboard']);

    //Total Order
    Route::get('/kitchen/totalorder',[KitchenTotalOrderController::class,'index']);
    Route::get('/kitchen/order_details/{id}',[KitchenTotalOrderController::class,'orderDetails']);
    Route::get('/kitchen/order_status_update/{id}',[KitchenTotalOrderController::class,'order_status_update']);
});

//Kitchen End


//Customer Start
Route::get('/',[CustomerLoginController::class,'index']);
Route::get('/login',[CustomerLoginController::class,'index']);
Route::post('/auth',[CustomerLoginController::class,'auth'])->name('auth');

Route::group(['middleware'=>'customer_auth'],function(){
    Route::get('/logout', function () {
        session()->forget('CUSTOMER_LOGIN');
        session()->forget('TABLE_ID');
        session()->forget('TABLE_NO');
        session()->flash('msg','Logout Successfully');
        return redirect('/');
    });

    Route::get('/dashboard',[CustomerLoginController::class,'dashboard']);

    //Collect Order
    Route::get('/collect_order',[CustomerCollectOrderController::class,'index']);
    Route::get('/collect_order/{id}',[CustomerCollectOrderController::class,'get_category_data']);
    Route::get('/cart/{id}',[CustomerCollectOrderController::class,'cart_data']);
    Route::get('/cart_update/{id}',[CustomerCollectOrderController::class,'cart_data_update']);
    Route::get('/cart_delete/{id}',[CustomerCollectOrderController::class,'cart_data_dalete']);
    Route::get('/collect_order/manage_collect_order',[CustomerCollectOrderController::class,'manage_collect_order']);
    Route::get('/collect_order/status/{status}/{id}',[CustomerCollectOrderController::class,'status']);
    Route::post('/collect_order/manage_collect_order_process',[CustomerCollectOrderController::class,'manage_collect_order_process'])->name('collect_order.manage_collect_order_process');
    Route::get('/collect_order/manage_collect_order/{id}',[CustomerCollectOrderController::class,'manage_collect_order']);
    Route::get('/collect_order/delete/{id}',[CustomerCollectOrderController::class,'destroy']);
    Route::post('/order',[CustomerCollectOrderController::class,'order'])->name('order');

    //Total Order
    Route::get('/totalorder',[CustomerTotalOrderController::class,'index']);
    Route::get('/order_details/{id}',[CustomerTotalOrderController::class,'orderDetails']);
    Route::get('/order_status_update/{id}',[CustomerTotalOrderController::class,'order_status_update']);
});

//Customer End

//Waiter Start

Route::get('/waiter/',[WaiterLoginController::class,'index']);
Route::get('/waiter/login',[WaiterLoginController::class,'index']);
Route::post('/waiter/auth',[WaiterLoginController::class,'auth'])->name('waiter.auth');

Route::group(['middleware'=>'waiter_auth'],function(){
    Route::get('waiter/logout', function () {
        session()->forget('WAITER_LOGIN');
        session()->forget('WAITER_ID');
        session()->forget('TABLE_ID');
        session()->flash('msg','Logout Successfully');
        return redirect('/waiter/');
    });

    Route::get('/waiter/dashboard',[WaiterLoginController::class,'dashboard']);

    //Total Order
    Route::get('/waiter/totalorder',[WaiterTotalOrderController::class,'index']);
    Route::get('/waiter/order_details/{id}',[WaiterTotalOrderController::class,'orderDetails']);
    Route::get('/waiter/order_status_update/{id}',[WaiterTotalOrderController::class,'order_status_update']);
});

//Waiter End

