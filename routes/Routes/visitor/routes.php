<?php
Route::group(['middleware' => ['web']], function () {
    //LANDING PAGE//
    Route::get('/', 'Visitor\VisitorController@index')->name('index');

    //NEWSLETTER//
    Route::get('/visitor/newsletter/', 'Visitor\VisitorController@newsletter')->name('visitor.newsletter');

    //News Detail
    Route::get('/visitor/news_detail/{id}', 'Visitor\VisitorController@news_detail');

    //ROOM//
    Route::get('/visitor/rooms/', 'Visitor\VisitorController@rooms')->name('visitor.room');

    //FUNCTION ROOM//
    Route::get('/visitor/function_room/', 'Visitor\VisitorController@function_room')->name('visitor.function_room');

    //MICE & WEDDING//
    Route::get('/visitor/mice_wedding/', 'Visitor\VisitorController@mice_wedding')->name('visitor.mice_wedding');

    //ALLYSEA A SPA//
    Route::get('/visitor/allysea_spa/', 'Visitor\VisitorController@allysea_spa')->name('visitor.allysea_spa');

    //RECREATION//
    Route::get('/visitor/recreation/', 'Visitor\VisitorController@recreation')->name('visitor.recreation');

    // INQUIRY //
    Route::get('/visitor/inquiry/', 'Visitor\InquiryController@inquiry')->name('inquiry.index');
    Route::post('/visitor/insert/', 'Visitor\InquiryController@inquiry_insert')->name('inquiry.insert');

    Route::get('/paymentcheck', 'Visitor\VisitorController@payment_check');
    Route::post('/generatewords', 'Visitor\VisitorController@generate_words')->name('visitor.generate_words');
});

//HALAMAN PACKAGE-RECREATION DETAIL//
Route::get('/visitor/recreation_detail', function () {
    return view('visitor_site.recreation.recreation_detail');
});

//HALAMAN PACKAGE-SPA DETAIL//
Route::get('/visitor/allyseaspa_detail', function () {
    return view('visitor_site.allysea_spa.allyseaspa_detail');
});

//HALAMAN PACKAGE-MICEWEDDING DETAIL//
Route::get('/visitor/micewedding_detail', function () {
    return view('visitor_site.mice_wedding.micewedding_detail');
});

//HALAMAN PACKAGE-FUNCTIONROOM DETAIL//
Route::get('/visitor/fr_detail', function () {
    return view('visitor_site.function_room.fr_detail');
});

Route::get('/visitor/news_detail', 'Visitor\VisitorController@news_detail');

//HALAMAN DETAILS//
Route::get('/visitor/details', 'Visitor\VisitorController@details');
