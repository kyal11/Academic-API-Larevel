<?php

use App\Http\Controllers\Api\MahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('mahasiswa',MahasiswaController::class);

Route::get('mahasiswa',[MahasiswaController::class,'index']);
Route::get('mahasiswa/{id}',[MahasiswaController::class,'show']);
Route::post('mahasiswa',[MahasiswaController::class,'store']);
Route::put('mahasiswa/{id}',[MahasiswaController::class,'update']);
Route::delete('mahasiswa/{id}',[MahasiswaController::class,'destroy']);