<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\SptController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

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
    return view('word');
});

Route::resource('spt', SptController::class);
Route::post('spt/simpan', [SptController::class, 'create']);

Route::post('word/{data}', [WordController::class, 'index']);
Route::get('download', [DownloadController::class, 'download']);
