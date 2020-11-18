<?php

use App\Http\Controllers\Api\ManuscriptsController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\QueryListController;
use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ManuscriptsWorkflowController;
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

// 登录
Route::post('authorizations', [AuthorizationsController::class, 'store'])
    ->name('authorizations.store');
// 刷新token
Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
    ->name('authorizations.update');
// 删除token
Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
    ->name('authorizations.destroy');
Route::middleware('auth:api')->group(function () {
    Route::get('user', [UsersController::class, 'mine'])->name('user.show');
    Route::resource('media', MediaController::class);
    Route::resource('roles', RolesController::class);
    Route::get('articles', [QueryListController::class, 'query']);
    Route::get('image', [QueryListController::class, 'image']);
    Route::post('upload/image', [UploadController::class, 'image']);
    Route::post('upload/file', [UploadController::class, 'file']);
    Route::post('download/image', [QueryListController::class, 'download']);
    Route::resource('manuscripts', ManuscriptsController::class);
    Route::patch('manuscripts-workflow/{manuscript}', [ManuscriptsWorkflowController::class, 'update']);
    Route::patch('manuscripts-workflow/reviews/{manuscript}', [ManuscriptsWorkflowController::class, 'review']);
    Route::get('manuscripts-workflow/reviews/channels', [ManuscriptsWorkflowController::class, 'channel']);
});
