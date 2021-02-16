<?php
// test email rsvp
Route::get('/test-email-rsvp', 'Payment\TestingController@testEmailRsvp');

// test email inquiry
Route::get('/test-email-inquiry', 'Payment\TestingController@testEmailInquiry');

// test payment debit
Route::get('/test-payment-debit','Payment\TestingController@paymentNotificationDebit')->name('test.debit.payment');

// test payment credit
Route::get('/test-payment-credit','Payment\TestingController@paymentNotificationCredit')->name('test.credit.payment');

// check payment debit
Route::get('/check-payment-debit','Payment\TestingController@checkPaymentDebit');
Route::post('/status-payment-debit','Payment\TestingController@resultPaymentDebit')->name('status.payment.debit');

// check payment credit
Route::get('/check-payment-credit','Payment\TestingController@checkPaymentCredit');
Route::post('/status-payment-credit','Payment\TestingController@resultPaymentCredit')->name('status.payment.credit');

// result one payment code
Route::get('/one-list-payment','Payment\TestingController@onePaymentChannel');

// check payment bca klikpay
Route::get('/check-payment-klikpay','Payment\TestingController@checkPaymentKlikpay');
