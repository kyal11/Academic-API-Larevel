<?php

use App\Http\Controllers\MhsContoller;
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

// front end mahasiswa

Route::get('mahasiswa',[MhsContoller::class,'index']);
Route::post('mahasiswa',[MhsContoller::class,'store']);
Route::get('mahasiswa/{id}',[MhsContoller::class,'edit']);
Route::put('mahasiswa/{id}',[MhsContoller::class,'update']);
Route::delete('mahasiswa/{id}',[MhsContoller::class,'destroy'])->name('mahasiswa.destroy');