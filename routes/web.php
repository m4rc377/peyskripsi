<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
 */
/* Route::get('/', function () {
    return view('index');
}); */
Route::get('/', 'HomeController@index')->name('home.index');

/* Route::get('/slip_dfgdfg', 'SlipGajiController@index')->name('slip.index'); */
Route::post('/slip', 'SlipGajiController@lihat')->name('slip.lihat');

Route::get('/slip/{slip}', 'SlipGajiController@show')->name('slip.show');
Route::post('/slip/{slip}', 'SlipGajiController@show')->name('slip.show');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// bcz logout canot automaticaly detect get, we bypass using get on route
Route::get('logout', function () {
    /*
    auth()->logout();
    Session()->flush();
    */
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
})->name('logout');

Route::get('/home', function () {
    return redirect('/pegawai');
})->name('home')->middleware('auth');

/* =================== Ini di auth nanti =================== */
Route::group(['middleware' => 'auth'], function () {
                Route::prefix('pegawai')->group(function () {
                    //Route::get('/getData', 'PegawaiController@getData')->name('pegawai.getData');
                });
                Route::resource('/pegawai', 'PegawaiController');
                Route::get('/data', 'PegawaiController@data')->name('pegawai.data');

                Route::resource('/gaji', 'GajiController');
                /* Route::resource('/pengajuan-gaji', 'PengajuanGajiController'); */

                /* Routing Pengaturan */
                Route::group(['prefix' => '/pengaturan', 'namespace' => 'Pengaturan'], function () {
                    Route::resource('/agama', 'AgamaController');
                    Route::resource('/pernikahan', 'PernikahanController');
                    Route::resource('/kelamin', 'KelaminController');
                    Route::group(['prefix' => '/jabatan', 'namespace' => 'Jabatan'],function () {
                        Route::resource('/posisi', 'PosisiController');
                        Route::resource('/golongan', 'GolonganController');
                    }
                );

                //Route::resource('/pendidikan', 'PendidikanController');
                Route::group(['prefix' => '/pendidikan', 'namespace' => 'Pendidikan'], function () {
                        Route::resource('/institusi', 'InstitusiController');
                        Route::resource('/jenjang', 'JenjangController');
                    }
                );
                Route::group(
                    ['prefix' => '/gaji', 'namespace' => 'Gaji'],
                    function () {
                        Route::resource('/gaji-pokok', 'PokokController');
                        Route::resource('/gaji-potongan', 'PotonganController');
                        Route::resource('/gaji-tunjangan', 'TunjanganController');
                    }
                );
            }
        );

        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        /* Routing Users */
        Route::resource('/users', 'UsersController');
}
        );







Route::get('/testing2', function () {
    return view('testing2');
});



//Route::get('crop-image-before-upload-using-croppie', 'CropImageController@index');
//Route::post('crop-image-before-upload-using-croppie', ['as' => 'croppie.upload-image', 'uses' => 'CropImageController@uploadCropImage']);
