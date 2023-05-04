<?php

use Illuminate\Support\Facades\Route;


//-------------- admin
Route::get('/admin','App\Http\Controllers\AdminController@index');
//đăng xuất:
Route::get('/logout','App\Http\Controllers\AdminController@logout');

Route::post('/admin-dashboard','App\Http\Controllers\AdminController@check_login');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
// điều khiển khi đăng nhập admin đúng thì vào dashboard

// Khách hàng
Route::get('/all-customer','App\Http\Controllers\AdminController@customer');
Route::get('/customer-order/{customerId}','App\Http\Controllers\AdminController@customer_order');

//order-admin
Route::get('/manage-order', 'App\Http\Controllers\Checkout@manage_order');
Route::get('/view-order/{order_id}', 'App\Http\Controllers\Checkout@view_order');
//xác nhận đơn hàng
Route::get('/comfim-order/{order_id}', 'App\Http\Controllers\Checkout@comfim_order');
Route::get('/cancel-order/{order_id}', 'App\Http\Controllers\Checkout@cancel_order');


  //Sách
  Route::get('/add-book','App\Http\Controllers\Book@add_book');
  Route::get('/edit-book/{book_id}','App\Http\Controllers\Book@edit_book');
  Route::get('/delete-book/{book_id}','App\Http\Controllers\Book@delete_book');
  Route::get('/all-book','App\Http\Controllers\Book@all_book');

  //đổi cái active ẩn-hiện sách
  Route::get('/active-book/{book_id}','App\Http\Controllers\Book@active_book');
  Route::get('/unactive-book/{book_id}','App\Http\Controllers\Book@unactive_book');


  Route::post('/save-book','App\Http\Controllers\Book@save_book');
  Route::post('/update-book/{book_id}','App\Http\Controllers\Book@update_book');
  // chi tiết sách
  Route::get('/quan-ly-chi-tiet-sach/{book_id}','App\Http\Controllers\Book@qly_chitiet_book');


//Danh mục sản phẩm
    Route::get('/add-category','App\Http\Controllers\Category@add_category');
    Route::get('/edit-category/{category_id}','App\Http\Controllers\Category@edit_category');
    Route::get('/delete-category/{category_id}','App\Http\Controllers\Category@delete_category');
    Route::get('/all-category','App\Http\Controllers\Category@all_category');
    //đổi cái active ẩn-hiện danh mục
    Route::get('/active-category/{category_id}','App\Http\Controllers\Category@active_category');
    Route::get('/unactive-category/{category_id}','App\Http\Controllers\Category@unactive_category');


    Route::post('/save-category','App\Http\Controllers\Category@save_category');
    Route::post('/update-category/{category_id}','App\Http\Controllers\Category@update_category');


    // NXB
    //Danh mục sản phẩm
    Route::get('/add-publisher','App\Http\Controllers\Publisher@add_publisher');
    Route::get('/edit-publisher/{publisher_id}','App\Http\Controllers\Publisher@edit_publisher');
    Route::get('/delete-publisher/{publisher_id}','App\Http\Controllers\Publisher@delete_publisher');
    Route::get('/all-publisher','App\Http\Controllers\Publisher@all_publisher');

    //đổi cái active ẩn-hiện danh mục
    Route::get('/active-publisher/{publisher_id}','App\Http\Controllers\Publisher@active_publisher');
    Route::get('/unactive-publisher/{publisher_id}','App\Http\Controllers\Publisher@unactive_publisher');


    Route::post('/save-publisher','App\Http\Controllers\Publisher@save_publisher');
    Route::post('/update-publisher/{publisher_product_id}','App\Http\Controllers\Publisher@update_publisher');


  

// end admin--------------------------------

//--------------customer
Route::get('/show-history/{customerId}', 'App\Http\Controllers\Checkout@show_history');
Route::get('/view-history-order/{order_id}', 'App\Http\Controllers\Checkout@show_history_order');



//Trang chủ
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@tim_kiem');
Route::get('/contact','App\Http\Controllers\HomeController@contact');


//đăng ký, đăng nhập 
Route::get('/login','App\Http\Controllers\Checkout@login');// gọi hàm xử lý khi yêu cầu form đăng nhập
Route::get('/signup','App\Http\Controllers\Checkout@signup');//hàm gọi ra form đăng ký
Route::get('/logout-checkout', 'App\Http\Controllers\Checkout@logout');//đăng xuất
Route::get('/show-history/{customerId}', 'App\Http\Controllers\Checkout@show_history');// xem lịch sử mua hàng
Route::post('/login-customer', 'App\Http\Controllers\Checkout@login_customer');//xử lý đăng nhập
Route::post('/add-customer', 'App\Http\Controllers\Checkout@add_customer');// xử lý đăng ký



// xem sách thuộc Danh mục 
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\Category@show_category_home');
// NXB
Route::get('/nha-xuat-ban/{publisher_id}','App\Http\Controllers\Publisher@show_publisher_home');

// chi tiết sách
Route::get('/chi-tiet-sach/{book_id}','App\Http\Controllers\Book@show_book');

// giỏ hàng

Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_cart');
Route::get('/delete-all-cart', 'App\Http\Controllers\CartController@delete_all_cart');
Route::post('/update-cart-qty', 'App\Http\Controllers\CartController@update_cart_qty');


//checkout

Route::get('/show-checkout', 'App\Http\Controllers\Checkout@show_checkout');
Route::post('/save-checkout-customer', 'App\Http\Controllers\Checkout@save_checkout_customer');




