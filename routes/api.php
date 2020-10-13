<?php

use App\Http\Controllers\Api\QueryListController;
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
Route::post('query_list', [QueryListController::class, 'query']);
Route::get('image', [QueryListController::class, 'image']);
Route::post('download/image', [QueryListController::class, 'upload']);
Route::post('contents', [QueryListController::class, 'store']);
