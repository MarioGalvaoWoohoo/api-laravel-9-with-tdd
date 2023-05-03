<?php

use App\Http\Controllers\Api\{
    UserController,
    MessageController
};

use Illuminate\Support\Facades\Route;

Route::apiResource('/users', UserController::class);

Route::prefix('/v1')->group(function () {
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('/users', [UserController::class, 'listAll'])->name('users.listAll');

        Route::get('/messages', [MessageController::class, 'listAll'])->name('messages.listAll');
        Route::post('/message', [MessageController::class, 'store'])->name('messages.store');
        Route::get('/message/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::put('/message/{id}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('/messagesIsActive', [MessageController::class, 'messagesIsActive'])->name('messages.messageIsActive');
        Route::get('/messagesOnTimeIsActive', [MessageController::class, 'messagesOnTimeIsActive'])->name('messages.messageOnTimeIsActive');
        Route::get('/unreadMessages', [MessageController::class, 'unreadMessages'])->name('messages.unreadMessages');
        Route::put('/prioritizeMessage', [MessageController::class, 'prioritizeMessage'])->name('messages.prioritizeMessage');
        Route::delete('/deprioritizeMessage', [MessageController::class, 'deprioritizeMessage'])->name('messages.deprioritizeMessage');
    });
});
// Route::delete('/users/{email}', [UserController::class, 'destroy']);
// Route::put('/users/{email}', [UserController::class, 'update']);
// Route::get('/users/{email}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::get('/users', [UserController::class, 'index']);
