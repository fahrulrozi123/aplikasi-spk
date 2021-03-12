<?php
Route::group(['middleware' => ['web']], function () {
    //LANDING PAGE//
    Route::get('/', 'Visitor\VisitorController@index')->name('index');

    //NEWSLETTER//
    Route::get('/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');

    //News Detail
    Route::get('/news_detail/{id}', 'Visitor\VisitorController@news_detail');

    //ROOM//
    Route::get('/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');

    //FUNCTION ROOM//
    Route::get('/function-room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');

    //MICE//
    Route::get('/mice/', 'Visitor\VisitorController@mice')->name('visitor.mice_wedding');

    //WEDDING//
    Route::get('/wedding/', 'Visitor\VisitorController@wedding')->name('visitor.wedding');

    //ALLYSEA A SPA//
    Route::get('/wellness/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');

    //RECREATION//
    Route::get('/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');

    // INQUIRY //
    Route::get('/inquiry/', 'Visitor\InquiryController@inquiry')->name('inquiry.index');
    Route::post('/insert/', 'Visitor\InquiryController@inquiry_insert')->name('inquiry.insert');

    Route::get('/paymentcheck', 'Visitor\VisitorController@payment_check');
    Route::post('/generatewords', 'Visitor\VisitorController@generate_words')->name('visitor.generate_words');
});

//HALAMAN PACKAGE-RECREATION DETAIL//
Route::get('/recreation_detail', function () {
    return view('visitor_site.recreation.recreation_detail');
});

//HALAMAN PACKAGE-SPA DETAIL//
Route::get('/allyseaspa_detail', function () {
    return view('visitor_site.allysea_spa.allyseaspa_detail');
});

//HALAMAN PACKAGE-MICEWEDDING DETAIL//
Route::get('/micewedding_detail', function () {
    return view('visitor_site.mice_wedding.micewedding_detail');
});

//HALAMAN PACKAGE-FUNCTIONROOM DETAIL//
Route::get('/fr_detail', function () {
    return view('visitor_site.function_room.fr_detail');
});

Route::get('/news_detail', 'Visitor\VisitorController@news_detail');

//HALAMAN DETAILS//
Route::get('/details', 'Visitor\VisitorController@details');
