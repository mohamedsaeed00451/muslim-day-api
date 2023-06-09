<?php

use App\Http\Controllers\Api\User\{
    Auth\AuthController,
    Prayers\PrayerController,
    Qurans\QuranController
};
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

    'controller' => AuthController::class,
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
        'middleware' => ['api', 'check.api.password', 'check.lang']
    ]

    , function () {

    //*********************** Auth ***************************//

    Route::group([

        'controller' => AuthController::class,
        'prefix' => 'auth'

    ], function () {

        //*********************** login With Socialite ***************************//
        Route::post('/login/google', 'loginWithGoogle'); //Google
        Route::post('/login/facebook', 'loginWithFacebook'); // Facebook

        //*********************** login ***************************//
        Route::post('/login', 'login');
        //*********************** Add Device Token ***************************//
        Route::post('/device-token', 'addDeviceToken');
        //*********************** Register ***************************//
        Route::post('/register', 'register');
        //*********************** Email ***************************//
        Route::post('/email-verify-otp', 'emailVerify'); //check code
        Route::get('/email-verify-otp', 'resendOtpVerification'); // Resend Code

        Route::middleware(['jwt.verify'])->group(function () { //Auth JWT

            Route::post('/logout', 'logout'); //Logout
            Route::post('/refresh', 'refresh'); //Refresh Token
            Route::post('/profile', 'profile'); //Get Profile
            Route::post('/password', 'updatePassword'); //Update Password
            Route::post('/daily-tracker', 'addDailyTracker'); //add Daily Tracker
            Route::get('/daily-tracker', 'getDailyTracker'); //get Daily Tracker

        });
    });

    //*********************** Quran ***************************//
    Route::controller(QuranController::class)->group(function () {

        //*********************** Surahs ***************************//
        Route::get('/surahs', 'getSurahs');

        //*********************** Ayahs ***************************//
        Route::get('/surah/ayahs/{id}', 'getAyahsSurah');

        //*********************** Tafsirs ***************************//
        Route::get('/surah/tafsirs/{id}', 'getTafsirSurah');
        Route::get('/ayah/tafsir/{id}', 'getTafsirAyah');

        //*********************** Reciters ***************************//
        Route::get('/reciters', 'getReciters');
        Route::get('/reciter/surahs/{id}', 'getReciterSurahs');
        Route::get('/surah/reciters/{id}', 'getSurahReciters');

        //*********************** Audios ***************************//
        Route::get('/surah/reciter-audio', 'getSurahAudio');

        //*********************** Videos ***************************//
        Route::get('/videos', 'getVideos');
    });

    //*********************** Prayers ***************************//
    Route::controller(PrayerController::class)->group(function () {
        //*********************** get Prayer ***************************//
        Route::get('/prayers', 'getPrayerTimes');

    });

});


