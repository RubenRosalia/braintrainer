<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Baseline brain-trainer
Route::get('/', [GameController::class, 'home']);
Route::get('/mind', [GameController::class, 'mind']);
Route::get('/body', [GameController::class, 'body']);
Route::get('/games/{id}', [GameController::class, 'game']);

// Kept from the CRUD tutorial (optional)
Route::resource('posts', PostController::class);
