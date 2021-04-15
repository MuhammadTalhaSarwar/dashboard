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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/api_link', [App\Http\Controllers\HomeController::class, 'api_link']);
Route::get('/kannel_tps', [App\Http\Controllers\HomeController::class, 'kannel_tps'])->name('kannel_tps');
Route::get('/kannel_queue', [App\Http\Controllers\HomeController::class, 'kannel_queue'])->name('kannel_queue');
Route::get('/redis_stats', [App\Http\Controllers\HomeController::class, 'redis_stats'])->name('redis_stats');
Route::get('/mysql_seconds_behind', [App\Http\Controllers\HomeController::class, 'mysql_seconds_behind'])->name('mysql_behind');
Route::get('/kannel_smpp_port_check', [App\Http\Controllers\HomeController::class, 'kannel_smpp_port_check']);
Route::get('/smpp_links', [App\Http\Controllers\HomeController::class, 'smpp_links'])->name('smpp_links');
Route::get('/sinch_count', [App\Http\Controllers\HomeController::class, 'sinch_count'])->name('sinch_count');
Route::get('/linksStatus', [App\Http\Controllers\HomeController::class, 'linksStatus'])->name('linksStatus');
Route::get('/linksStatus2', [App\Http\Controllers\HomeController::class, 'linksStatus2'])->name('linksStatus2');
Route::get('/pointCodesStatus', [App\Http\Controllers\HomeController::class, 'pointCodesStatus'])->name('pointCodesStatus');
Route::get('/pointCodesStatus2', [App\Http\Controllers\HomeController::class, 'pointCodesStatus2'])->name('pointCodesStatus2');
Route::get('/guzzle', [App\Http\Controllers\HomeController::class, 'guzzle'])->name('guzzle');

