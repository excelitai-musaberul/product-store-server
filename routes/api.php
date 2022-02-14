<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductImagesController;
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
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');


//--------------- Auth Routes -------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/role', [AuthController::class, 'role']);

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/validToken', [AuthController::class, 'validToken']);



// Route::middleware('auth:sanctum', 'cors')->post('/products/delete/', [ProductController::class, 'delete']);
// Route::middleware('auth:sanctum')->post('/products/delete/{id}', [ProductController::class, 'delete']);


Route::middleware('auth:sanctum')->group(function () {
    
    //--------------- Products Route -------------------
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/products/{id}', [ProductController::class, 'update']);
    Route::post('/products/price/{id}', [ProductController::class, 'updatePrice']);   
    Route::get('/productsimage', [ProductImagesController::class, 'index']);
    Route::post('/productsimage', [ProductImagesController::class, 'upload']);
    Route::post('/products/delete/{id}', [ProductController::class, 'delete']);

    
    // Route::post('/products/test/', [ProductController::class, 'test']);
    // Route::post('/products/delete/{id}', [ProductController::class, 'delete']);
    // /Route::post('/products/delete/{id}', [ProductController::class, 'delete']);
    // /Route::post('/products/delete/{id}', [ProductController::class, 'delete']);
    

    // Route::put('/products/{id}', [ProductController::class, 'update']);
    // Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    //--------------- Categories Route -------------------
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);


    // Route::post('/logout', [AuthController::class, 'logout']);

   
});


