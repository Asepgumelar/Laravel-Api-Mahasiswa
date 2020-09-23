<?php

use App\Http\Controllers\Api\V1\MahasiswaController;
use App\Http\Controllers\Api\V1\MatkulController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('mahasiswa', [MahasiswaController::class, 'findAll']);
Route::get('mahasiswa/{id}', [MahasiswaController::class, 'findbyId']);
Route::post('mahasiswa/create', [MahasiswaController::class, 'postCreate']);
Route::post('mahasiswa/update', [MahasiswaController::class, 'postUpdate']);
Route::post('mahasiswa/delete', [MahasiswaController::class, 'delete']);

Route::get('matkul', [MatkulController::class, 'findAll']);
Route::get('matkul/{id}', [MatkulController::class, 'findbyId']);
Route::post('matkul/create', [MatkulController::class, 'postCreate']);
Route::post('matkul/update', [MatkulController::class, 'postUpdate']);
Route::post('matkul/delete', [MatkulController::class, 'delete']);
