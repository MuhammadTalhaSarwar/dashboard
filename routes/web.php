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
// Route::get('/api_link', [App\Http\Controllers\HomeController::class, 'api_link'])->name('api_link');
Route::get('/kannel_tps', [App\Http\Controllers\HomeController::class, 'kannel_tps'])->name('kannel_tps');
Route::get('/kannel_queue', [App\Http\Controllers\HomeController::class, 'kannel_queue'])->name('kannel_queue');
Route::get('/redis_stats', [App\Http\Controllers\HomeController::class, 'redis_stats'])->name('redis_stats');
Route::get('/mysql_seconds_behind', [App\Http\Controllers\HomeController::class, 'mysql_seconds_behind'])->name('mysql_behind');
// Route::get('/kannel_smpp_port_check', [App\Http\Controllers\HomeController::class, 'kannel_smpp_port_check'])->name('kannel_smpp_port_check');
// Route::get('/smpp_links', [App\Http\Controllers\HomeController::class, 'smpp_links'])->name('smpp_links');
Route::get('/sinch_stats', [App\Http\Controllers\HomeController::class, 'sinch_stats'])->name('sinch_stats');
// Route::get('/linksStatus', [App\Http\Controllers\HomeController::class, 'linksStatus'])->name('linksStatus');
// Route::get('/linksStatus2', [App\Http\Controllers\HomeController::class, 'linksStatus2'])->name('linksStatus2');
// Route::get('/pointCodesStatus', [App\Http\Controllers\HomeController::class, 'pointCodesStatus'])->name('pointCodesStatus');
// Route::get('/pointCodesStatus2', [App\Http\Controllers\HomeController::class, 'pointCodesStatus2'])->name('pointCodesStatus2');
Route::get('/guzzle', [App\Http\Controllers\HomeController::class, 'guzzle'])->name('guzzle');
Route::get('/guage', [App\Http\Controllers\GuageController::class, 'index'])->name('guage');

Route::get('/smpp_links', [App\Http\Controllers\GuageController::class, 'smpp_links'])->name('smpp_links');
Route::get('/linksStatus', [App\Http\Controllers\GuageController::class, 'linksStatus'])->name('linksStatus');
Route::get('/linksStatus2', [App\Http\Controllers\GuageController::class, 'linksStatus2'])->name('linksStatus2');
Route::get('/pointCodesStatus', [App\Http\Controllers\GuageController::class, 'pointCodesStatus'])->name('pointCodesStatus');
Route::get('/pointCodesStatus2', [App\Http\Controllers\GuageController::class, 'pointCodesStatus2'])->name('pointCodesStatus2');
Route::get('/kannel_smpp_port_check', [App\Http\Controllers\GuageController::class, 'kannel_smpp_port_check'])->name('kannel_smpp_port_check');
Route::get('/api_link', [App\Http\Controllers\GuageController::class, 'api_link'])->name('api_link');
Route::get('/repl_check', [App\Http\Controllers\GuageController::class, 'repl_check'])->name('repl_check');




Route::get('/event_trigger', [App\Http\Controllers\HomeController::class, 'event_trigger'])->name('event_trigger');

