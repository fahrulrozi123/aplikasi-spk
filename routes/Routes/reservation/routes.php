<?php
//Start Reservation //
Route::get('/visitor/custinfo/', 'Payment\ReserveController@custinfo')->name('visitor.reserve');
//Reserve Room//
Route::post('/visitor/reserve_room/', 'Payment\PaymentController@reserve_room')->name('visitor.reserve_room');
//Reserve Product//
Route::post('/visitor/reserve_product/', 'Payment\PaymentController@reserve_product')->name('visitor.reserve_product');

// ROOM RESERVATION //
Route::get('/visitor/reservation/', ['as' => 'visitor.reservation', 'uses' => 'Payment\ReserveController@reservation']);
Route::post('/visitor/room_reservation/', ['as' => 'visitor.room_reservation', 'uses' => 'Payment\ReserveController@room_reservation']);

//PRODUCT  RESERVATION //
Route::get('/get_product', ['as' => 'visitor.get_product', 'uses' => 'Payment\ReserveController@get_product']);
Route::post('/visitor/product_reservation/', ['as' => 'visitor.product_reservation', 'uses' => 'Payment\ReserveController@product_reservation']);

Route::get('/payment-channel', 'Payment\ReserveController@paymentChannel')->name('payment.channel');
Route::post('/checkout-room', ['as' => 'visitor.room_checkout', 'uses' => 'Payment\PaymentController@room_checkout']);
Route::post('/checkout-product', ['as' => 'visitor.product_checkout', 'uses' => 'Payment\PaymentController@product_checkout']);
Route::post('/credit', ['as' => 'visitor.credit', 'uses' => 'Payment\PaymentController@credit']);

//TEMPLATE EMAIL//
Route::get('/template_voucher', 'Payment\NotificationController@template_voucher');
Route::get('/template_email', 'Payment\NotificationController@template_email');
Route::get('/template_receipt', 'Payment\NotificationController@template_receipt');
