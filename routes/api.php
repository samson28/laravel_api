<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::get('refresh', 'refresh');
    Route::get('current', 'current');

});

Route::controller(EmployeController::class)->group(function () {
    Route::get('employe/all', 'index');
    Route::post('employe/store', 'store');
    Route::get('employe/show/{id}', 'show');
    Route::put('employe/update/{id}', 'update');
    Route::delete('employe/delete/{id}', 'destroy');
    Route::post('employe/search', 'search');
});