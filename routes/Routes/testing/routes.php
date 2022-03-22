<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix' => 'test'], function() {
        // TESTING FEATURE
        // Test Email RSVP
        Route::get('/email-rsvp', 'Testing\TestingFeatureController@testEmailRsvp');

        // Test Email Inquiry
        Route::get('/email-inquiry', 'Testing\TestingFeatureController@testEmailInquiry');

        // Check Allotment
        Route::get('/check-allotment','Testing\TestingFeatureController@checkAllotment');
        // END TESTING FEATURE

        // TESTING PAYMENT
        // Payment Channel Inquiry
        Route::get('/list-payment','Testing\TestingPaymentController@paymentChannel');
        // Result One Payment Code
        Route::get('/one-list-payment','Testing\TestingPaymentController@onePaymentChannel');

        // Check Payment Debit
        Route::get('/check-payment-debit','Testing\TestingPaymentController@checkPaymentDebit');
        Route::post('/status-payment-debit','Testing\TestingPaymentController@resultPaymentDebit')->name('status.payment.debit');

        // Check Payment Credit
        Route::get('/check-payment-credit','Testing\TestingPaymentController@checkPaymentCredit');
        Route::post('/status-payment-credit','Testing\TestingPaymentController@resultPaymentCredit')->name('status.payment.credit');

        // Check Payment BCA Klikpay
        Route::get('/check-payment-klikpay','Testing\TestingPaymentController@checkPaymentKlikpay');

        // Test Payment Notification Debit
        Route::get('payment-notify-debit','Testing\TestingPaymentController@paymentNotificationDebit')->name('test.payment.debit');
        // Test Payment Notification Credit
        Route::get('payment-notify-credit','Testing\TestingPaymentController@paymentNotificationCredit')->name('test.payment.credit');
        // END TESTING PAYMENT
    });

});
