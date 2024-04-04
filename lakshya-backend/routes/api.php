<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    $data = [
        'message' => 'Welcome to our API!',
        'status' => 'success'
    ];

    return response()->json($data);
});

Route::post('/register',[UserController::class,'register']);

//Route::post('/login',[AdminController::class,'login']);

Route::post('/adminlogs',[AuthController::class,'login']);