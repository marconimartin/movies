<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MovieController;

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
    return view('home');
})->name('home');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('admin', [HomeController::class, 'index'] )->middleware('can:admin.home')->name('admin.home');


Route::middleware(['auth:sanctum', 'verified'])->group( function () {

    Route::resource('admin/movies', MovieController::class)->names('admin.movies');

    Route::get ('/import/create', [MovieController::class, 'importCreate'])->name('admin.movies.import-create');
    Route::post('/import/store',  [MovieController::class, 'importStore' ])->name('admin.movies.import-store' );

});
