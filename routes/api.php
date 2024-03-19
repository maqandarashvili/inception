<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PrizeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\PlayerAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/player/login', [PlayerAuthController::class, 'login']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/player/profile', function (Request $request) {
    if ($request->user()->isPlayer()) {
        return response()->json($request->user());
    }
    return response()->json(['message' => 'Unauthorized'], 401);
});

Route::middleware('auth:sanctum')->get('/admin/profile', function (Request $request) {
    if ($request->user()->isAdmin()) {
        return response()->json($request->user());
    }
    return response()->json(['message' => 'Unauthorized'], 401);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/prizes', [PrizeController::class, 'store']);
    Route::post('/categories/{category}/assign-ranks', [CategoryController::class, 'assignRanks']);
    Route::post('/assign-prize', [PrizeController::class, 'assignToCategory']);

});

Route::middleware('auth:sanctum')->post('/spin', [PrizeController::class, 'spin']);

