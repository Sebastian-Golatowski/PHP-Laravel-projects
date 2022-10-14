<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
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

Route::apiResource('/tasks',TaskController::class,['only' => ['index', 'store', 'destroy','update']]);
// Route::apiResource('/tasks',TaskController::class);

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
