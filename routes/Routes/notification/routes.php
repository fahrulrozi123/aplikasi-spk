<?php
Route::group(['middleware' => ['web']], function () {
    //payment debit notification
    Route::post('/payment-notification', 'Payment\NotificationController@payment_notification')->name('payment.notification');

    //credit notification
    Route::post('/credit-notification', 'Payment\NotificationController@credit_notification')->name('credit.notification');

    //bca klikpay notification
    Route::post('/klikpay-notification', 'Payment\NotificationController@klikpay_notification')->name('klikpay.notification');
});
