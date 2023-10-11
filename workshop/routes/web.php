<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/ads', [App\Http\Controllers\AdsController::class, 'index'])->middleware('auth')->name('ads');
Route::get('/ads/get', [App\Http\Controllers\AdsController::class, 'getAds'])->name('getAds');
Route::post('/ads/search', [App\Http\Controllers\AdsController::class, 'search'])->name('search');
Route::post('/ads/filter', [App\Http\Controllers\AdsController::class, 'filter'])->name('filter');
Route::get('/ads/add', [App\Http\Controllers\AdsController::class, 'add'])->name('postAdd');
Route::post('/ads/create', [App\Http\Controllers\AdsController::class, 'create'])->name('create');

require __DIR__.'/auth.php';
