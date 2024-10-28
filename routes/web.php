<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
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


Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'invitation'], function () {
        Route::get('/', [InvitationController::class, 'index'])->middleware('auth:api');
        Route::get('/{id}', [InvitationController::class, 'show']);
        Route::post('/', [InvitationController::class, 'store'])->middleware('auth:api');
        Route::patch('/{id}', [InvitationController::class, 'update'])->middleware('auth:api');
        Route::delete('/{id}', [InvitationController::class, 'destroy'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'template'], function () {
        Route::get('/', [TemplateController::class, 'index']);
        Route::post('/', [TemplateController::class, 'store'])->middleware('auth:api');
        Route::get('/{id}', [TemplateController::class, 'show']);
        Route::patch('/{id}', [TemplateController::class, 'update'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'guest'], function () {
        Route::get('/', [GuestController::class, 'index'])->middleware('auth:api');
        Route::get('/{id}', [GuestController::class, 'show']);
        Route::post('/', [GuestController::class, 'store'])->middleware('auth:api');
        Route::patch('/{id}', [GuestController::class, 'update'])->middleware('auth:api');
        Route::delete('/{id}', [GuestController::class, 'destroy'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'payment'], function () {
        Route::get('/', [PaymentController::class, 'index'])->middleware('auth:api');
        Route::get('/{id}', [PaymentController::class, 'show'])->middleware('auth:api');
        Route::post('/{id}', [PaymentController::class, 'store'])->middleware('auth:api');
        Route::post('/callback', [PaymentController::class, 'callback'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', [SubscriptionController::class, 'index'])->middleware('auth:api');
        Route::get('/{id}', [SubscriptionController::class, 'index'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'media'], function () {
        Route::get('/{id}', [MediaController::class, 'index'])->middleware('auth:api');
        Route::post('/{id}', [MediaController::class, 'store'])->middleware('auth:api');
        Route::delete('/{id}', [MediaController::class, 'destroy'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'group'], function () {
        Route::get('/', [GroupController::class, 'index'])->middleware('auth:api');
        Route::post('/', [GroupController::class, 'store'])->middleware('auth:api');
        Route::get('/{id}', [GroupController::class, 'show'])->middleware('auth:api');
        Route::patch('/{id}', [GroupController::class, 'update'])->middleware('auth:api');
        Route::delete('/{id}', [GroupController::class, 'destroy'])->middleware('auth:api');
    });
});
