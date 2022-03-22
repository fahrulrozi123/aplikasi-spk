<?php
//Auth Login//
// Auth::routes();
Route::get('enter_site', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('enter_site', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    // Dashboard
    Route::get('/admin_site', 'Dashboard\HomeController@index')->name('admin.index');
    Route::get('/dashboard', 'Dashboard\HomeController@index')->name('admin.index');

    Route::get('/dashboard/reservation_this_month', 'Dashboard\HomeController@reservation_this_month')->name('dashboard.reservation_this_month');
    Route::get('/dashboard/online_product_today', 'Dashboard\HomeController@online_product_today')->name('dashboard.online_product_today');
    Route::get('/dashboard/offline_product_today', 'Dashboard\HomeController@offline_product_today')->name('dashboard.offline_product_today');
    Route::get('/dashboard/room_today', 'Dashboard\HomeController@room_today')->name('dashboard.room_today');

    // Report
    Route::get('/main_page/report', 'Admin\ReportController@report');

    // For Download Report
    Route::post('/main_page/report/download', ['as' => 'report.download', 'uses' => 'Reservation\ReservationController@export']);

    // Reservation Report //
    Route::get('/main_page/reservation_report', 'Admin\ReportController@reservation_report');

    // Customer Report //
    Route::get('/main_page/customer_report', 'Admin\ReportController@customer_report');

    // Allotment Report //
    Route::get('/main_page/allotment_report', 'Admin\ReportController@allotment_report');
});
