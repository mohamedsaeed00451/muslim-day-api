<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(
    [
        'middleware' => ['api','check.api.password','check.lang']
    ]

    ,function (){


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



});


