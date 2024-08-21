<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaymentController;
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
        Route::get('/{id}', [InvitationController::class, 'show']);
        Route::patch('/', [InvitationController::class, 'update']);
    });
    Route::group(['prefix' => 'template'], function () {
        Route::get('/', [TemplateController::class, 'index']);
        Route::post('/', [TemplateController::class, 'store']);
        Route::get('/{slug}', [TemplateController::class, 'show']);
        Route::patch('/', [TemplateController::class, 'update']);
    });
    Route::group(['prefix' => 'guest'], function () {
        Route::get('/', [GuestController::class, 'index']);
        Route::post('/', [GuestController::class, 'store']);
        Route::get('/{slug}', [GuestController::class, 'show']);
        Route::patch('/', [GuestController::class, 'update']);
        Route::delete('/', [GuestController::class, 'destroy']);
    });
    Route::group(['prefix' => 'payment'], function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'create']);
        Route::post('/callback', [PaymentController::class, 'callback']);
        Route::patch('/', [PaymentController::class, 'update']);
        Route::delete('/', [PaymentController::class, 'destroy']);
    });
    Route::group(['prefix' => 'group'], function () {
        Route::get('/', [GroupsController::class, 'index']);
        Route::post('/', [GroupsController::class, 'store']);
        Route::get('/{slug}', [GroupsController::class, 'show']);
        Route::patch('/', [GroupsController::class, 'update']);
        Route::delete('/', [GroupsController::class, 'destroy']);
    });
});
