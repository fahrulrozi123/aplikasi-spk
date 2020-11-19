<?php

//TESTING EMAIL ROOM//
Route::get('/testemail', 'Payment\TestingController@test_email');

//TESTING EMAIL INQUIRY//
Route::get('/testemail2', 'Payment\TestingController@test_email2');

//push notification
Route::get('/push','Payment\TestingController@push')->name('push');

//store a push subscriber.
Route::post('/push','Payment\TestingController@storeNotification');
