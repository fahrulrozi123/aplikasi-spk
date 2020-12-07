<?php

//TESTING EMAIL ROOM//
Route::get('/testemail', 'Payment\TestingController@test_email');

//TESTING EMAIL INQUIRY//
Route::get('/testemail2', 'Payment\TestingController@test_email2');

//push notification
Route::get('/push','Payment\TestingController@push')->name('push');

//store a push subscriber.
Route::post('/push','Payment\TestingController@storeNotification');

// payment check
Route::get('/check-payment','Payment\TestingController@checkPayment');
Route::post('/status-payment','Payment\NotificationController@payment_check')->name('status.payment');

// test payment
Route::get('/test-payment','Payment\TestingController@paymentNotification')->name('test.payment');

Route::get('/one-list-payment','Payment\PaymentController@listPaymentChannel');
