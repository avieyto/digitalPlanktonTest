<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthUserController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Notification\NotificationController;

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

Route::post('auth/login', [AuthUserController::class, 'login'])->name('login');
Route::post('auth/register', [AuthUserController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth:api', 'json.response', 'JsonApiMiddleware']], function() {
    //user detail route
    Route::get('/user', [UserController::class, 'details']);

    //notifications routes
    Route::apiResource('notifications', NotificationController::class);

    Route::get('/wikipedia/articles/{terms}', [\App\Http\Controllers\Api\Wikipedia\WikipediaController::class, 'get'])->name('wikipedia_get_10_articles');
});
