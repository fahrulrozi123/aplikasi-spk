<?php
Route::group(['middleware' => ['web']], function () {
    //payment API
    Route::post('/payment-notification', 'Payment\NotificationController@payment_notification');
    Route::post('/payment-success', 'Payment\NotificationController@payment_success');
    Route::get('/payment-unfinish', 'Payment\NotificationController@payment_unfinish');
    Route::get('/payment-error', 'Payment\NotificationController@payment_error');
});
