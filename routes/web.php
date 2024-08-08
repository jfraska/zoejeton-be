<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TemplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::get('/auth/redirect/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('/auth/check', [AuthController::class, 'session'])->middleware('auth:api');


Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'invitation'], function () {
        Route::get('/', [InvitationController::class, 'index']);
        Route::post('/', [InvitationController::class, 'store']);
        // Route::delete('/', [App\Http\Controllers\PurchaseOrderController::class, 'destroy'])->middleware('apimid:purchaseOrder:destroy');
        // Route::get('/show', [App\Http\Controllers\PurchaseOrderController::class, 'show'])->middleware('apimid:purchaseOrder:show');
    });
    Route::group(['prefix' => 'template'], function () {
        Route::get('/', [TemplateController::class, 'index']);
        Route::post('/', [TemplateController::class, 'store']);
        // Route::delete('/', [App\Http\Controllers\PurchaseOrderController::class, 'destroy'])->middleware('apimid:purchaseOrder:destroy');
        // Route::get('/show', [App\Http\Controllers\PurchaseOrderController::class, 'show'])->middleware('apimid:purchaseOrder:show');
    });
});
