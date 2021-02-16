<?php
Route::group(['middleware' => ['web']], function () {
    //payment debit notification
    Route::post('/payment-notification', 'Payment\NotificationController@payment_notification')->name('payment.notification');

    //credit notification
    Route::post('/credit-notification', 'Payment\NotificationController@credit_notification')->name('credit.notification');

    //internet banking notification
    Route::post('/ibank-notification', 'Payment\NotificationController@ibank_notification')->name('ibank.notification');
});
