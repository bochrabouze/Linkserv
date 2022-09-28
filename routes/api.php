<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoniteurController;
use App\Http\Controllers\EleveController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('moniteur', MoniteurController::class);
// ->only([
//     'index'
//     // , 'show'
// ]);
// Route::resource('eleve', EleveController::class);
// ->only([
//     'index'
//     // , 'show'
// ]);