<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controller\AuthContrller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {


});

 # get all resource news / mendapatkan semua resource
    # membuat method get
    Route::get('/news', [NewsController::class, 'index']);

    # menambahkan resource news
    # membuat method post
    Route::post('/news', [NewsController::class, 'store']);

    # mendapatkan detail resource news
    # membuat method get
    Route::get('/news/{id}', [NewsController::class, 'show']);

    # mempebaruhi resource news
    # membuat method put
    Route::put('/news/{id}', [NewsController::class, 'update']);

    # menghapus resource news
    # membuat method delete
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    # membuat method get search
    Route::get('/news/search/{title}', [NewsController::class, 'search']);

    # membuat method untuk mendapatkan data sport
    Route::get('/news/category/sport', [NewsController::class, 'sport']);

    # membuat method untuk mendapatkan data finance
    Route::get('/news/category/finance', [NewsController::class, 'finance']);

    # membuat method untuk mendapatkan data automotive
    Route::get('/news/category/automotive', [NewsController::class, 'automotive']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
