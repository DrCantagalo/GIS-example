<?php

//use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/assets/geojson', [\App\Http\Controllers\AssetController::class, 'geojson']);
Route::get('/assets/stats', [\App\Http\Controllers\AssetController::class, 'stats']);

Route::post('userdata', function() { //ve por token passport user data
    $user = Auth::user();
    return $user;
})->middleware('auth:api');
