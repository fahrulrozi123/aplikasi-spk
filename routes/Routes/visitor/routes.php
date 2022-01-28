<?php
Route::group(['middleware' => ['web']], function () {
    //LANDING PAGE//
    Route::get('/', 'Visitor\VisitorController@index')->name('index');

    //ROOM//
    Route::get('/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');
    //ROOM DETAIL//
    Route::get('/room/{slug}', 'Visitor\VisitorController@roomDetail');

    //RECREATION//
    Route::get('/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');
    //RECREATION DETAIL//
    Route::get('/recreation/{slug}', 'Visitor\VisitorController@recreationDetail');

    //ALLYSEA A SPA//
    Route::get('/wellness/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');
    //RECREATION DETAIL//
    Route::get('/wellness/{slug}', 'Visitor\VisitorController@allyseaSpaDetail');

    //MICE//
    Route::get('/mice/', 'Visitor\VisitorController@mice')->name('visitor.mice_wedding');
    //MICE DETAIL//
    Route::get('/mice/{slug}', 'Visitor\VisitorController@miceDetail');

    //WEDDING//
    Route::get('/wedding/', 'Visitor\VisitorController@wedding')->name('visitor.wedding');
    //WEDDING DETAIL//
    Route::get('/wedding/{slug}', 'Visitor\VisitorController@weddingDetail');

    //FUNCTION ROOM//
    Route::get('/function-room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');
    //FUNCTION ROOM DETAIL//
    Route::get('/function-room/{slug}', 'Visitor\VisitorController@functiomRoomDetail');
    //FUNCTION ROOM MICE WEDDING DETAIL//
    Route::get('/mice-wedding/{slug}', 'Visitor\VisitorController@functiomRoomMiceWeddingDetail');

    //NEWSLETTER//
    Route::get('/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');
    //NEWSLETTER DETAIL//
    Route::get('/newsletter/{slug}', 'Visitor\VisitorController@news_detail');

    // INQUIRY //
    Route::get('/inquiry/', 'Visitor\InquiryController@inquiry')->name('inquiry.index');
    Route::post('/insert/', 'Visitor\InquiryController@inquiry_insert')->name('inquiry.insert');
});
