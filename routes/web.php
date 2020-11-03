<?php

use App\Http\Controllers\FishController;
use App\Http\Controllers\FishingController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuario/configuracoes', [UserController::class, 'index'])->name('user.index');
Route::patch('/usuario/update', [UserController::class, 'update'])->name('user.update');
Route::delete('usuario/delete', [UserController::class, 'delete'])->name('user.delete');

Route::get('/peixes/criar', [FishController::class, 'create'])->name('fishes.create');
Route::get('/peixes/{id}', [FishController::class, 'show'])->name('fishes.show');
Route::post('/peixes/store', [FishController::class, 'store'])->name('fishes.store');
Route::patch('/peixes/update', [FishController::class, 'update'])->name('fishes.update');
Route::delete('peixes/delete', [FishController::class, 'delete'])->name('fishes.delete');

Route::get('/pescarias/agendar', [FishingController::class, 'create'])->name('fishings.create');
Route::post('/pescarias/store', [FishingController::class, 'store'])->name('fishings.store');

Route::get('/classificações', [RankingController::class, 'index'])->name('ranking');