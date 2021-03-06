<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->get('me', function (Request $request) {
    return auth()->user();
});

// Register Routes
Route::post('register', [API\AuthController::class, 'register']);
Route::post('login', [API\AuthController::class, 'login']);
Route::post('logout', [API\AuthController::class, 'logout']);

Route::apiResources([
    'bikes' => API\BikeController::class,
    'builders' => API\BuilderController::class,
    'items' => API\ItemController::class,
    'bikes/{bike}/ratings' => API\RatingController::class
]);
