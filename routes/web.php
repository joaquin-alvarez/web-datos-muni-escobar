<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatasetController;

Route::get('/', [DatasetController::class, 'index'])->name('home');
Route::get('/datasets', [DatasetController::class, 'index'])->name('datasets.index');
Route::get('/dataset/{slug}', [DatasetController::class, 'show'])->name('datasets.show');
