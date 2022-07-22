<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/create', [UserController::class, 'create'])->name('create');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:api');

Route::prefix('v1')->group(function () {
    Route::group(['prefix'=>'/admin/products','middleware'=>['auth:api','scope:admin']],function () {
        Route::get('/', [ProductController::class,'index']);
        Route::post('/', [ProductController::class,'store']);
        Route::put('/{id}', [ProductController::class,'update']);
        Route::get('/{id}', [ProductController::class,'show']);
        Route::delete('/{id}', [ProductController::class,'destroy']);
    });
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class,'index']);
        Route::get('/{id}', [ProductController::class,'show'])->where('id', '[0-9]+');
    });
});

Route::prefix('v1')->group(function () {
    Route::group(['prefix'=>'/admin/category','middleware'=>['auth:api','scope:admin']],function () {
        Route::get('/', [CategoryController::class,'index']);
        Route::post('/', [CategoryController::class,'store']);
        Route::put('/{id}', [CategoryController::class,'update']);
        Route::get('/{id}', [CategoryController::class,'show']);
        Route::delete('/{id}', [CategoryController::class,'delete']);
    });
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class,'index']);
        Route::get('/{id}', [CategoryController::class,'show'])->where('id', '[0-9]+');
    });
});


