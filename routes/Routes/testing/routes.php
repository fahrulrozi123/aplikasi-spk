<?php

//TESTING EMAIL ROOM//
Route::get('/testemail', 'Payment\TestingController@test_email');

//TESTING EMAIL INQUIRY//
Route::get('/testemail2', 'Payment\TestingController@test_email2');

//push notification
Route::get('/push','Payment\TestingController@push')->name('push');

//store a push subscriber.
Route::post('/push','Payment\TestingController@storeNotification');

// test payment debit
Route::get('/test-payment-debit','Payment\TestingController@paymentNotificationDebit')->name('test.debit.payment');

// test payment credit
Route::get('/test-payment-credit','Payment\TestingController@paymentNotificationCredit')->name('test.credit.payment');

// check payment debit
Route::get('/check-payment-debit','Payment\TestingController@checkPaymentDebit');
Route::post('/status-payment-debit','Payment\NotificationController@payment_check_debit')->name('status.payment.debit');

// check payment credit
Route::get('/check-payment-credit','Payment\TestingController@checkPaymentCredit');
Route::post('/status-payment-credit','Payment\NotificationController@payment_check_credit')->name('status.payment.credit');

// result one payment code
Route::get('/one-list-payment','Payment\PaymentController@listPaymentChannel');
