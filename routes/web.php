<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MOUController;
use App\Http\Controllers\ActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('search-index');
});

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search-index');
Route::get('/search/results', [\App\Http\Controllers\SearchController::class, 'advance'])->name('search');

// Department Routes
Route::resource('departments', DepartmentController::class);
Route::resource('activities', ActivityController::class);




Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', App\Http\Controllers\UserController::class);

Route::group(['middleware' => 'auth'], function() {
    Route::resource('mous', MOUController::class);
    Route::get('/export-csv', [MOUController::class, 'export'])->name('export.csv');
    Route::post('/import-csv', [MOUController::class, 'import'])->name('import.csv');
});
