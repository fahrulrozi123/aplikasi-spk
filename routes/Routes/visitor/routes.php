<?php
Route::group(['middleware' => ['web']], function () {
    // Landing Page
    Route::get('/', 'Visitor\VisitorController@rooms')->name('index');

    // Room
    Route::get('/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');
    // Room Detail
    Route::get('/rooms/{slug}', 'Visitor\VisitorController@roomDetail')->name('room.slug');

    // Recreation
    // Route::get('/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');
    // // Recreation Detail
    // Route::get('/recreation/{slug}', 'Visitor\VisitorController@recreationDetail')->name('recreation.slug');

    // // Wellness
    // Route::get('/wellness/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');
    // // Wellness Detail
    // Route::get('/wellness/{slug}', 'Visitor\VisitorController@allyseaSpaDetail')->name('allysea_spa.slug');

    // // MICE
    // Route::get('/mice/', 'Visitor\VisitorController@mice')->name('visitor.mice_wedding');
    // // MICE Detail
    // Route::get('/mice/{slug}', 'Visitor\VisitorController@miceDetail')->name('mice_wedding.slug');

    // // Wedding
    // Route::get('/wedding/', 'Visitor\VisitorController@wedding')->name('visitor.wedding');
    // // Wedding Detail//
    // Route::get('/wedding/{slug}', 'Visitor\VisitorController@weddingDetail')->name('wedding.slug');

    // Function Room
    Route::get('/function-room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');
    // Function Room Detail//
    Route::get('/function-room/{slug}', 'Visitor\VisitorController@functiomRoomDetail')->name('functionroom.slug');
    // Function Room, MICE Wedding Detail//
    Route::get('/mice-wedding/{slug}', 'Visitor\VisitorController@functiomRoomMiceWeddingDetail')->name('micewedding.slug');

    // Newsletter
    Route::get('/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');
    // Newsletter Detail//
    Route::get('/newsletter/{slug}', 'Visitor\VisitorController@news_detail')->name('newsletter.slug');

    // Inquiry
    Route::get('/inquiry/', 'Visitor\InquiryController@inquiry')->name('inquiry.index');
    Route::post('/insert/', 'Visitor\InquiryController@inquiry_insert')->name('inquiry.insert');

    // Halman Details Old
    Route::get('/details', 'Visitor\VisitorController@details');
});
