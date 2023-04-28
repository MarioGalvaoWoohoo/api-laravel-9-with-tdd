<?php

use App\Http\Controllers\Api\{
    UserController
};
use Illuminate\Support\Facades\Route;

// Route::apiResource('/users', UserController::class);

Route::prefix('/v1')->group(function () {
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('/users', [UserController::class, 'listAll'])->name('users.listAll');
    });
});
// Route::delete('/users/{email}', [UserController::class, 'destroy']);
// Route::put('/users/{email}', [UserController::class, 'update']);
// Route::get('/users/{email}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::get('/users', [UserController::class, 'index']);
