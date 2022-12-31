<?php

use App\Http\Controllers\mahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/tes','analisaTopsis@get_positif_distance'); 
Route::get('/tes2',function(){
    $users = DB::table('mahasiswa')->select(DB::raw('SUM(prestasi) as jumlah'))->first();
    return $users->jumlah;
});
Route::group(['as' =>'admin.','middleware'=> 'auth'],function(){
    Route::get('/', function () {
        $data['mahasiswa'] = count(\App\Model\Mahasiswa::all());
        $data['Teknik'] = count(\App\Model\Mahasiswa::where('fakultas','Teknik')->get());
        $data['FIKES'] = count(\App\Model\Mahasiswa::where('fakultas','FIKES')->get());
        $data['Hukum'] = count(\App\Model\Mahasiswa::where('fakultas','Hukum')->get());
        $data['FEB'] = count(\App\Model\Mahasiswa::where('fakultas','FEB')->get());
        $data['FAI'] = count(\App\Model\Mahasiswa::where('fakultas','FAI')->get());
        $data['FISIP'] = count(\App\Model\Mahasiswa::where('fakultas','FISIP')->get());
        $data['FKIP'] = count(\App\Model\Mahasiswa::where('fakultas','FKIP')->get());
        return view('admin.dashboard',$data);
    });
    Route::get('/mahasiswa', function () {
        return view('admin.mahasiswa.index');
    });
    Route::get('/setting', function () {
        $options = \App\Model\Setting::getAllKeyValue();
        return view('admin.setting',$options);
    });
    Route::get('/linguistik', function () {
        return view('admin.topsis.linguistik');
    });
    Route::get('/matrix_keputusan', function () {
        return view('admin.topsis.matrix_keputusan');
    });
    Route::get('/matrix_keputusan_ternormalisasi', function () {
        return view('admin.topsis.matrix_keputusan_ternormalisasi');
    });
    Route::get('/matrix_keputusan_terbobot', function () {
        return view('admin.topsis.matrix_keputusan_terbobot');
    });
    Route::get('/jarak_solusi_positif', function () {
        return view('admin.topsis.jarak_solusi_positif');
    });
    Route::get('/jarak_solusi_negatif', function () {
        return view('admin.topsis.jarak_solusi_negatif');
    });
    Route::get('/nilai_preferensi', function () {
        return view('admin.topsis.nilai_preferensi');
    });
    Route::get('/hasil_rekomendasi', function () {
        return view('admin.topsis.hasil_rekomendasi');
    });
    Route::get('/matrix_solusi_ideal','analisaTopsis@solusi_ideal');

    // export excel
    Route::get('/export-excel', 'analisaTopsis@exportexcel')->name('export-excel');
    Route::get('/export-topsis-excel', 'analisaTopsis@exportexcel')->name('export-topsis-excel');
    // export PDF
    Route::get('/export-pdf', 'analisaTopsis@exportpdfpreferensi')->name('export-pdf');
    Route::get('/export-pdf-topsis', 'analisaTopsis@exportpdf')->name('export-pdf-topsis');
    
    Route::group(['prefix' => 'admin'], function(){
        Route::group(["as" => "mahasiswa.", "prefix" => "mahasiswa"], function () {
            Route::get('/', 'mahasiswaController@index')->name('index');
            Route::get('/data', 'mahasiswaController@data')->name('data');
            Route::post('/add', 'mahasiswaController@store')->name('add');
            Route::post('/edit', 'mahasiswaController@edit')->name('edit');
            Route::post('/delete', 'mahasiswaController@delete')->name('delete');
            
        });
        Route::group(["as" => "topsis.", "prefix" => "topsis"], function () {
            Route::get('/linguistik', 'analisaTopsis@linguistik')->name('linguistik');
            Route::get('/matrix_keputusan', 'analisaTopsis@matrix_keputusan')->name('matrix_keputusan');
            Route::get('/matrix_keputusan_ternormalisasi', 'analisaTopsis@matrix_keputusan_ternormalisasi')->name('matrix_keputusan_ternormalisasi');
            Route::get('/matrix_keputusan_terbobot', 'analisaTopsis@matrix_keputusan_terbobot')->name('matrix_keputusan_terbobot');
            Route::get('/jarak_solusi_positif', 'analisaTopsis@jarak_solusi_positif')->name('jarak_solusi_positif');
            Route::get('/jarak_solusi_negatif', 'analisaTopsis@jarak_solusi_negatif')->name('jarak_solusi_negatif');
            Route::get('/nilai_preferensi', 'analisaTopsis@nilai_preferensi')->name('nilai_preferensi');   
        });
        
        Route::group(["as" => "setting.", "prefix" => "setting"], function () {
            Route::post('/bobot', 'settingController@bobot')->name('bobot');            
        });
    });

});
Route::get('/masuk',function(){
    return view('admin.login');
}); 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
