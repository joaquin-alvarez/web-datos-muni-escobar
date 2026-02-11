<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::prefix('v1')->group(function () {
    Route::get('/datasets', [ApiController::class, 'datasets'])->name('api.v1.datasets');
    Route::get('/datasets/{slug}', [ApiController::class, 'dataset'])->name('api.v1.dataset');
    Route::get('/categories', [ApiController::class, 'categories'])->name('api.v1.categories');
    Route::get('/glossary', [ApiController::class, 'glossary'])->name('api.v1.glossary');
    Route::get('/officials', [ApiController::class, 'officials'])->name('api.v1.officials');
    Route::get('/organisms', [ApiController::class, 'organisms'])->name('api.v1.organisms');
    Route::get('/government-areas', [ApiController::class, 'governmentAreas'])->name('api.v1.government-areas');
});
