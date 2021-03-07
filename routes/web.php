<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('index');
});*/

Route::middleware('guest')->group(function () {

    Route::get('/{advert}', [\App\Http\Controllers\AdvertController::class, 'show'])->where('advert', '[0-9]+')->name('show');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginHandle']);

});

Route::get('/', [\App\Http\Controllers\AdvertController::class, 'index'])->name('index');
Route::get('/{advert}', [\App\Http\Controllers\AdvertController::class, 'show'])->where('advert', '[0-9]+')->name('show');

Route::middleware('auth')->group(function () {

    Route::post('/', [\App\Http\Controllers\AdvertController::class, 'store'])->name('store');
    Route::get('/edit', [\App\Http\Controllers\AdvertController::class, 'create'])->name('create');
    Route::put('/edit/{advert}', [\App\Http\Controllers\AdvertController::class, 'update'])->name('update');
    Route::delete('/{advert}', [\App\Http\Controllers\AdvertController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{advert}', [\App\Http\Controllers\AdvertController::class, 'edit'])->name('edit');
    Route::get('/user/{user}', [\App\Http\Controllers\AdvertController::class, 'searchByUser'])->name('searchByUser');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

});

//Route::get('/',[\App\Http\Controllers\AdvertController::class,'index']);
//Route::resource('advert',\App\Http\Controllers\AdvertController::class);



