<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::resource('/users', 'Admin\UserController');

    // Gudang Routes
    Route::get('/gudang', [App\Http\Controllers\Admin\GudangController::class, 'index'])->name('gudang.index');
    Route::get('/gudang/create', [App\Http\Controllers\Admin\GudangController::class, 'create'])->name('gudang.create');
    Route::get('/gudang/{id}/edit', [App\Http\Controllers\Admin\GudangController::class, 'edit'])->name('gudang.edit');
    Route::post('/gudang/store', [App\Http\Controllers\Admin\GudangController::class, 'store'])->name('gudang.store');
    Route::put('/gudang/{id}/update', [App\Http\Controllers\Admin\GudangController::class, 'update'])->name('gudang.update');
    Route::delete('/gudang/{id}/destroy', [App\Http\Controllers\Admin\GudangController::class, 'destroy'])->name('gudang.destroy');

    // Stock Routes
    Route::get('/gudang/{id}/stock',[App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/{id}',[App\Http\Controllers\Admin\StockController::class, 'destroy'])->name('stock.destroy');
    Route::get('/stock/{id}/cetak',[App\Http\Controllers\Admin\StockController::class, 'show'])->name('stock.show');
    Route::post('/stock/store', [App\Http\Controllers\Admin\StockController::class, 'store'])->name('stock.store');
    Route::delete('/stock/destroy/{id}', [App\Http\Controllers\Admin\StockController::class, 'destroy'])->name('stock.destroy');

    Route::get('/peminjaman', [App\Http\Controllers\Admin\PeminjamanController::class, 'index'])->name('peminjaman.index');

});