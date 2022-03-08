<?php
Route::group(['middleware' => ['web']], function () {
    //LANDING PAGE//
    Route::get('/', 'Visitor\VisitorController@index')->name('index');

    //ROOM//
    Route::get('/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');
    //ROOM DETAIL//
    Route::get('/rooms/{slug}', 'Visitor\VisitorController@roomDetail')->name('room.slug');

    //RECREATION//
    Route::get('/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');
    //RECREATION DETAIL//
    Route::get('/recreation/{slug}', 'Visitor\VisitorController@recreationDetail')->name('recreation.slug');

    //ALLYSEA A SPA//
    Route::get('/wellness/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');
    //RECREATION DETAIL//
    Route::get('/wellness/{slug}', 'Visitor\VisitorController@allyseaSpaDetail')->name('allysea_spa.slug');

    //MICE//
    Route::get('/mice/', 'Visitor\VisitorController@mice')->name('visitor.mice_wedding');
    //MICE DETAIL//
    Route::get('/mice/{slug}', 'Visitor\VisitorController@miceDetail')->name('mice_wedding.slug');

    //WEDDING//
    Route::get('/wedding/', 'Visitor\VisitorController@wedding')->name('visitor.wedding');
    //WEDDING DETAIL//
    Route::get('/wedding/{slug}', 'Visitor\VisitorController@weddingDetail')->name('wedding.slug');

    //FUNCTION ROOM//
    Route::get('/function-room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');
    //FUNCTION ROOM DETAIL//
    Route::get('/function-room/{slug}', 'Visitor\VisitorController@functiomRoomDetail')->name('functionroom.slug');
    //FUNCTION ROOM MICE WEDDING DETAIL//
    Route::get('/mice-wedding/{slug}', 'Visitor\VisitorController@functiomRoomMiceWeddingDetail')->name('micewedding.slug');

    //NEWSLETTER//
    Route::get('/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');
    //NEWSLETTER DETAIL//
    Route::get('/newsletter/{slug}', 'Visitor\VisitorController@news_detail')->name('newsletter.slug');

    // INQUIRY //
    Route::get('/inquiry/', 'Visitor\InquiryController@inquiry')->name('inquiry.index');
    Route::post('/insert/', 'Visitor\InquiryController@inquiry_insert')->name('inquiry.insert');

    //HALAMAN DETAILS OLD//
    Route::get('/details', 'Visitor\VisitorController@details');
});
