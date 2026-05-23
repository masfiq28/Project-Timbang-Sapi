<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/weighings/create', \App\Livewire\WeighingForm::class)->name('weighings.create');
    Route::get('/weighings/{weighing}/edit', \App\Livewire\WeighingForm::class)->name('weighings.edit');
    Route::get('/weighings/{weighing}/print', [\App\Http\Controllers\PrintController::class, 'print'])->name('weighings.print');
    Route::get('/export/weighings/{period}', [\App\Http\Controllers\ExportController::class, 'export'])->name('export.weighings');
});
