<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return redirect()->route('portfolio.create');
});

Route::get('/portfolio/create', [PortfolioController::class, 'create'])
    ->name('portfolio.create');

Route::post('/portfolio', [PortfolioController::class, 'store'])
    ->name('portfolio.store');

Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])
    ->name('portfolio.show');

Route::get('/portfolio/{id}/choose-template', [PortfolioController::class, 'chooseTemplate'])
    ->name('portfolio.choose-template');

Route::post('/portfolio/{id}/select-template', [PortfolioController::class, 'selectTemplate'])
    ->name('portfolio.select-template');

Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])
    ->name('portfolio.edit');

Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])
    ->name('portfolio.update');

Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])
    ->name('portfolio.destroy');