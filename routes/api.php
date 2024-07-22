<?php

use App\Http\Controllers\Api\AdminProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/test', function (Request $request) {
       return 'test';
    });
Route::post('admin/login', [AuthController::class,'loginCustomer']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('admin/get-admin-details', [AdminProfileController::class,'getAdminDetails']);
    Route::post('admin/change-password', [AdminProfileController::class,'updatePassword']);
    Route::post('admin/update-profile', [AdminProfileController::class,'updateProfile']);
});