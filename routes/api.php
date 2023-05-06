<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetFileController;
use App\Http\Controllers\ManyToManyController;
use App\Http\Controllers\CmpWithDBController;
use App\Http\Controllers\SaveCategoryController;
use App\Http\Controllers\GetCategoriesController;
use App\Http\Controllers\CmpWithCategoryController;

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

Route::post('/uploadfile', GetFileController::class);
Route::post('/uploadfile/withdb', CmpWithDBController::class);
Route::post('/uploadfile/withcategory', CmpWithCategoryController::class);
Route::post('/uploadfile/savecategory', SaveCategoryController::class);
Route::post('/getcategories', GetCategoriesController::class);
Route::post('/uploadfile/manytomany', ManyToManyController::class);