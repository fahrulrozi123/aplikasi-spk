<?php
Route::group(['middleware' => ['web', 'auth']], function () {

    // PANEL Package
    Route::group(['prefix' => 'master_data/package'], function() {
        Route::get('/', ['as' => 'package.index', 'uses' => 'Master\PackageController@index']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'package.create', 'uses' => 'Master\PackageController@create']);
        Route::post('/insert', ['as' => 'package.insert', 'uses' => 'Master\PackageController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'package.edit', 'uses' => 'Master\PackageController@edit']);
        Route::post('/update', ['as' => 'package.update', 'uses' => 'Master\PackageController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'package.delete', 'uses' => 'Master\PackageController@delete']);
        //AJAX
        Route::get('/setdata/{id}', ['as' => 'package.setdata', 'uses' => 'Master\PackageController@setdata']);
    });

    // PANEL Room
    Route::group(['prefix' => 'master_data/room'], function() {
        Route::get('/', ['as' => 'room.index', 'uses' => 'Master\RoomController@index']);
        //get ROOM DATA
        Route::get('/data', ['as' => 'room.data', 'uses' => 'Master\RoomController@data']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'room.create', 'uses' => 'Master\RoomController@create']);
        Route::post('/insert', ['as' => 'room.insert', 'uses' => 'Master\RoomController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'room.edit', 'uses' => 'Master\RoomController@edit']);
        Route::post('/update', ['as' => 'room.update', 'uses' => 'Master\RoomController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'room.delete', 'uses' => 'Master\RoomController@delete']);
        //AJAX
        Route::get('/setdata/{id}', ['as' => 'room.setdata', 'uses' => 'Master\RoomController@setdata']);
    });

    // PANEL Amenities
    Route::group(['prefix' => 'master_data/amenities'], function() {
        Route::get('/', ['as' => 'amenities.index', 'uses' => 'Master\AmenitiesController@index']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'amenities.create', 'uses' => 'Master\AmenitiesController@create']);
        Route::post('/insert', ['as' => 'amenities.insert', 'uses' => 'Master\AmenitiesController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'amenities.edit', 'uses' => 'Master\AmenitiesController@edit']);
        Route::post('/update', ['as' => 'amenities.update', 'uses' => 'Master\AmenitiesController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'amenities.delete', 'uses' => 'Master\AmenitiesController@delete']);
        //AJAX
        Route::get('/setdata/{id}', ['as' => 'amenities.setdata', 'uses' => 'Master\AmenitiesController@setdata']);
    });

    // PANEL Banner
    Route::group(['prefix' => 'master_data/banner'], function() {
        Route::get('/', ['as' => 'banner.index', 'uses' => 'Master\BannerController@index']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'banner.create', 'uses' => 'Master\BannerController@create']);
        Route::post('/insert', ['as' => 'banner.insert', 'uses' => 'Master\BannerController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'banner.edit', 'uses' => 'Master\BannerController@edit']);
        Route::post('/update', ['as' => 'banner.update', 'uses' => 'Master\BannerController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'banner.delete', 'uses' => 'Master\BannerController@delete']);
        //AJAX
        Route::get('/{id?}', ['as' => 'banner.setdata', 'uses' => 'Master\BannerController@setdata']);
    });

    // PANEL News
    Route::group(['prefix' => 'master_data/news'], function() {
        Route::get('/', ['as' => 'news.index', 'uses' => 'Master\NewsController@index']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'news.create', 'uses' => 'Master\NewsController@create']);
        Route::post('/insert', ['as' => 'news.insert', 'uses' => 'Master\NewsController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'news.edit', 'uses' => 'Master\NewsController@edit']);
        Route::post('/update', ['as' => 'news.update', 'uses' => 'Master\NewsController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'news.delete', 'uses' => 'Master\NewsController@delete']);
        //UPLOAD FOR TEXT EDITOR
        Route::post('/upload', ['as' => 'news.upload', 'uses' => 'Master\NewsController@upload']);
        //AJAX
        Route::get('/setdata/{id}', ['as' => 'news.setdata', 'uses' => 'Master\NewsController@setdata']);
    });

    // PANEL Function Room
    Route::group(['prefix' => 'master_data/function_room'], function() {
        Route::get('/', ['as' => 'function_room.index', 'uses' => 'Master\FuncRoomController@index']);
        //CREATE INSERT
        Route::get('/create', ['as' => 'function_room.create', 'uses' => 'Master\FuncRoomController@create']);
        Route::post('/insert', ['as' => 'function_room.insert', 'uses' => 'Master\FuncRoomController@insert']);
        //EDIT UPDATE
        Route::get('/edit/{id}', ['as' => 'function_room.edit', 'uses' => 'Master\FuncRoomController@edit']);
        Route::post('/update', ['as' => 'function_room.update', 'uses' => 'Master\FuncRoomController@update']);
        //DELETE
        Route::post('/delete', ['as' => 'function_room.delete', 'uses' => 'Master\FuncRoomController@delete']);
        //AJAX
        Route::get('/setdata/{id}', ['as' => 'function_room.setdata', 'uses' => 'Master\FuncRoomController@setdata']);
    });
});
