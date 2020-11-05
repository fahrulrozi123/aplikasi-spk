<?php

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

//AUTH LOGIN//
// Auth::routes();
Route::get('enter_site', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('enter_site', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['web']], function () {

//LANDING PAGE//
    Route::get('/', 'Visitor\VisitorController@index')->name('index');
//NEWSLETTER//
    Route::get('/visitor/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');
//News Detail
    Route::get('/visitor/news_detail/{id}', 'Visitor\VisitorController@news_detail');
//ROOM//
    Route::get('/visitor/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');

//FUNCTION ROOM//
    Route::get('/visitor/function_room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');

//MICE & WEDDING//
    Route::get('/visitor/mice_wedding/', 'Visitor\VisitorController@mice_wedding')->name('visitor.mice_wedding');
//ALLYSEA A SPA//
    Route::get('/visitor/allysea_spa/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');
//RECREATION//
    Route::get('/visitor/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');

// ROOM RESERVATION //
    Route::get('/visitor/reservation/', ['as' => 'visitor.reservation', 'uses' => 'Visitor\VisitorController@reservation']);
    Route::post('/visitor/room_reservation/', ['as' => 'visitor.room_reservation', 'uses' => 'Visitor\VisitorController@room_reservation']);


//PRODUCT  RESERVATION //
    Route::get('/get_product', ['as' => 'visitor.get_product', 'uses' => 'Visitor\VisitorController@get_product']);
    Route::post('/visitor/product_reservation/', ['as' => 'visitor.product_reservation', 'uses' => 'Visitor\VisitorController@product_reservation']);

//Start Reservation //
    Route::get('/visitor/custinfo/', 'Visitor\VisitorController@custinfo')->name('visitor.reserve');
    //Reserve Room//
    Route::post('/visitor/reserve_room/', 'Visitor\VisitorController@reserve_room')->name('visitor.reserve_room');
    //Reserve Product//
    Route::post('/visitor/reserve_product/', 'Visitor\VisitorController@reserve_product')->name('visitor.reserve_product');

// INQUIRY //
    Route::get('/visitor/inquiry/', 'Visitor\VisitorController@inquiry')->name('inquiry.index');
    Route::post('/visitor/insert/', 'Visitor\VisitorController@inquiry_insert')->name('inquiry.insert');

    Route::get('/paymentcheck', 'Visitor\VisitorController@payment_check');
    Route::post('/generatewords', 'Visitor\VisitorController@generate_words')->name('visitor.generate_words');


//payment API
    Route::post('/payment-notification', 'Visitor\VisitorController@payment_notification');
    Route::post('/payment-success', 'Visitor\VisitorController@payment_success');
    Route::get('/payment-unfinish', 'Visitor\VisitorController@payment_unfinish');
    Route::get('/payment-error', 'Visitor\VisitorController@payment_error');

});

//push notification
    Route::get('/push','Visitor\VisitorController@push')->name('push');
//store a push subscriber.
    Route::post('/push','Visitor\VisitorController@storeNotification');

//HALAMAN DETAILS//
Route::get('/visitor/details', 'Visitor\VisitorController@details');

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    Route::get('/admin_site', 'Dashboard\HomeController@index')->name('admin.index');
    Route::get('/dashboard', 'Dashboard\HomeController@index')->name('admin.index');

    Route::get('/dashboard/reservation_this_month', 'Dashboard\HomeController@reservation_this_month')->name('dashboard.reservation_this_month');
    Route::get('/dashboard/online_product_today', 'Dashboard\HomeController@online_product_today')->name('dashboard.online_product_today');
    Route::get('/dashboard/offline_product_today', 'Dashboard\HomeController@offline_product_today')->name('dashboard.offline_product_today');
    Route::get('/dashboard/room_today', 'Dashboard\HomeController@room_today')->name('dashboard.room_today');

    //REPORT//
    Route::get('/main_page/report', 'Admin\ReportController@report');

    //FOR DOWNLOAD REPORT
    Route::post('/main_page/report/download', ['as' => 'report.download', 'uses' => 'Reservation\ReservationController@export']);

    // Reservation Report //
    Route::get('/main_page/reservation_report', 'Admin\ReportController@reservation_report');

    // Customer Report //
    Route::get('/main_page/customer_report', 'Admin\ReportController@customer_report');

    // Allotment Report //
    Route::get('/main_page/allotment_report', 'Admin\ReportController@allotment_report');
});

require_once __DIR__ . '/Routes/main_page/routes.php';
require_once __DIR__ . '/Routes/master_data/routes.php';

Route::get('/visitor/news_detail', 'Visitor\VisitorController@news_detail');

//TEMPLATE EMAIL//
Route::get('/template_voucher', 'Visitor\VisitorController@template_voucher');
Route::get('/template_email', 'Visitor\VisitorController@template_email');
Route::get('/template_receipt', 'Visitor\VisitorController@template_receipt');

//TESTING EMAIL ROOM//
Route::get('/testemail', 'Visitor\VisitorController@test_email');
//TESTING EMAIL INQUIRY//
Route::get('/testemail2', 'Visitor\VisitorController@test_email2');


//HALAMAN PACKAGE-RECREATION DETAIL//
Route::get('/visitor/recreation_detail', function () {
    return view('visitor_site.recreation.recreation_detail');
});

//HALAMAN PACKAGE-SPA DETAIL//
Route::get('/visitor/allyseaspa_detail', function () {
    return view('visitor_site.allysea_spa.allyseaspa_detail');
});

//HALAMAN PACKAGE-MICEWEDDING DETAIL//
Route::get('/visitor/micewedding_detail', function () {
    return view('visitor_site.mice_wedding.micewedding_detail');
});

//HALAMAN PACKAGE-FUNCTIONROOM DETAIL//
Route::get('/visitor/fr_detail', function () {
    return view('visitor_site.function_room.fr_detail');
});

