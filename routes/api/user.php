<?php

use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\Prayers\PrayerController;
use App\Http\Controllers\Api\User\Qurans\QuranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'controller' => AuthController::class ,
    'prefix' => 'auth',
    'middleware' => ['api']

], function () {

    //*********************** login With Google callback ***************************//
    Route::get('/login/google/callback', 'loginWithGoogleCallback');
    //*********************** login With Facebook callback ***************************//
    Route::get('/login/facebook/callback', 'loginWithFacebookCallback');
});


Route::group(
    [
        'middleware' => ['api','check.api.password','check.lang']
    ]

    ,function (){

        Route::group([

            'controller' => AuthController::class ,
            'prefix' => 'auth'

        ], function () {

            //*********************** login With Socialite ***************************//
            Route::post('/login/google', 'loginWithGoogle'); //Google
            Route::post('/login/facebook', 'loginWithFacebook'); // Facebook

            //*********************** login ***************************//
            Route::post('/login', 'login');

            Route::post('/register', 'register');

            Route::middleware(['jwt.verify'])->group(function (){

                Route::post('/logout', 'logout');
                Route::post('/refresh', 'refresh');
                Route::post('/profile', 'profile');
                Route::post('/password', 'updatePassword');

            });
        });

         //*********************** Quran ***************************//
        Route::controller(QuranController::class)->group(function (){

            //*********************** Surahs ***************************//
            Route::get('/surahs','getSurahs');

            //*********************** Ayahs ***************************//
            Route::get('/surah/ayahs/{id}','getAyahsSurah');

            //*********************** Tafsirs ***************************//
            Route::get('/surah/tafsirs/{id}','getTafsirSurah');
            Route::get('/ayah/tafsir/{id}','getTafsirAyah');

            //*********************** Reciters ***************************//
            Route::get('/reciters','getReciters');
            Route::get('/reciter/surahs/{id}','getReciterSurahs');
            Route::get('/surah/reciters/{id}','getSurahReciters');
        });

        //*********************** Auth ***************************//
        Route::controller(AuthController::class)->group(function (){
            //*********************** Add Device Token ***************************//
            Route::post('/device-token','addDeviceToken');

        });

        //*********************** Prayers ***************************//
        Route::controller(PrayerController::class)->group(function (){
            //*********************** get Prayer ***************************//
            Route::get('/prayers','getPrayerTimes');

        });


});


