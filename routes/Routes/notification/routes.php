<?php
Route::group(['middleware' => ['web']], function () {
    //payment notification
    Route::post('/payment-notification', 'Payment\NotificationController@payment_notification')->name('payment.notification');
    Route::post('/payment-success', 'Payment\NotificationController@payment_success');
    Route::get('/payment-unfinish', 'Payment\NotificationController@payment_unfinish');
    Route::get('/payment-error', 'Payment\NotificationController@payment_error');

    //credit notification
    Route::post('/credit-notification', 'Payment\NotificationController@credit_notification')->name('credit.notification');
});
