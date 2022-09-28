<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PermisController;
use App\Http\Controllers\ForfaitController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\OutilController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\ApplicantController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/bochra', function () {
    return view('bochra');
});

Route::get('/regt', function () {
    return view('regt');
});


Route::get('/serve', function () {
    return view('serve');
});

Route::get('/servan', function () {
    return view('servan');
});

Route::get('/app', function () {
    return view('app');
});
Auth::routes();

Route::get('/art/optimize', [OutilController::class, 'optimize'])->name('optimize');
Route::get('/art/clear', [OutilController::class, 'clear'])->name('clear');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/app/forfait', ForfaitController::class);
// ->only([
//     'index'
//     // , 'show'
// ]);
Route::resource('/app/permis', PermisController::class)
->only([
    'index'
    // , 'show'
]);

Route::resource('/app/application', ApplicationController::class);

Route::resource('/app/service', ServiceController::class);

Route::resource('/app/servant', ServantController::class);


Route::resource('/app/applicant', ApplicantController::class);
Route::get('{any}', function () {
    return view('home');
})->where('any', '.*');