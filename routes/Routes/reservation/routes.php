<?php
// Reserve Room
Route::post('/reserve_room/', 'Payment\PaymentController@reserve_room')->name('visitor.reserve_room');
// Reserve Product
Route::post('/reserve_product/', 'Payment\PaymentController@reserve_product')->name('visitor.reserve_product');

// Room Reservation
Route::get('/reservation/', ['as' => 'visitor.reservation', 'uses' => 'Payment\ReserveController@reservation']);
Route::get('/', 'Payment\ReserveController@reservation')->name('index');
Route::post('/room_reservation/', ['as' => 'visitor.room_reservation', 'uses' => 'Payment\ReserveController@room_reservation']);

// Product Reservation
Route::get('/get_product', ['as' => 'visitor.get_product', 'uses' => 'Payment\ReserveController@get_product']);
Route::post('/product_reservation/', ['as' => 'visitor.product_reservation', 'uses' => 'Payment\ReserveController@product_reservation']);
Route::get('/package-reservation/', ['as' => 'visitor.package_reservation', 'uses' => 'Payment\ReserveController@packageReservation']);

// Get Payment Channel
Route::get('/payment-channel', 'Payment\ReserveController@paymentChannel')->name('payment.channel');

// Checkout
Route::post('/checkout-room', ['as' => 'visitor.room_checkout', 'uses' => 'Payment\PaymentController@room_checkout']);
Route::post('/checkout-product', ['as' => 'visitor.product_checkout', 'uses' => 'Payment\PaymentController@product_checkout']);

// Credit Payment
Route::post('/credit', ['as' => 'visitor.credit', 'uses' => 'Payment\PaymentController@credit']);

// Template Email
Route::get('/template_voucher', 'Payment\NotificationController@template_voucher');
Route::get('/template_email', 'Payment\NotificationController@template_email');
Route::get('/template_receipt', 'Payment\NotificationController@template_receipt');
