<?php

use Illuminate\Support\Facades\Route;
use Japananimetime\Sberbank\Http\Controllers\CallbackController;

Route::get('/api/callback/success', [CallbackController::class, 'success']);
Route::get('/api/callback/failure', [CallbackController::class, 'failure']);
