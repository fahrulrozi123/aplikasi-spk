<?php
Route::group(['middleware' => ['web']], function () {
    // Debit Notification
    Route::post('/payment-notification', 'Payment\NotificationController@payment_notification')->name('payment.notification');

    // Credit Notification
    Route::post('/credit-notification', 'Payment\NotificationController@credit_notification')->name('credit.notification');

    // BCA Klikpay Notification
    Route::post('/klikpay-notification', 'Payment\NotificationController@klikpay_notification')->name('klikpay.notification');
});
