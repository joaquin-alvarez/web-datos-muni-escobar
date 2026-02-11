<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\GovernmentController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\ApiController;

Route::get('/', [DatasetController::class, 'index'])->name('home');
Route::get('/datasets', [DatasetController::class, 'index'])->name('datasets.index');
Route::get('/dataset/{slug}', [DatasetController::class, 'show'])->name('datasets.show');

Route::get('/glosario', [GlossaryController::class, 'index'])->name('glossary.index');

Route::get('/autoridades', [GovernmentController::class, 'authorities'])->name('government.authorities');
Route::get('/funcionarios', [GovernmentController::class, 'officials'])->name('government.officials');
Route::get('/organismos', [GovernmentController::class, 'organisms'])->name('government.organisms');
Route::get('/contacto-areas', [GovernmentController::class, 'contact'])->name('government.contact');

Route::get('/solicitar-informacion', [InformationRequestController::class, 'create'])->name('information-request.create');
Route::post('/solicitar-informacion', [InformationRequestController::class, 'store'])->name('information-request.store');

Route::prefix('api')->group(function () {
    Route::get('/datasets', [ApiController::class, 'datasets'])->name('api.datasets');
    Route::get('/datasets/{slug}', [ApiController::class, 'dataset'])->name('api.dataset');
    Route::get('/categories', [ApiController::class, 'categories'])->name('api.categories');
    Route::get('/glossary', [ApiController::class, 'glossary'])->name('api.glossary');
    Route::get('/officials', [ApiController::class, 'officials'])->name('api.officials');
    Route::get('/organisms', [ApiController::class, 'organisms'])->name('api.organisms');
    Route::get('/government-areas', [ApiController::class, 'governmentAreas'])->name('api.government-areas');
});
