<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'list'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/movie')->group(function () {
    Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/add', [MovieController::class, 'store'])->name('movie.store');
    Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movie.update');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
})->middleware(['auth', 'verified', 'IsAdmin']);

Route::get('movie/{id}', [MovieController::class, 'show'])->name('movie.show');

Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');

Route::prefix('/category')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
})->middleware(['auth', 'verified', 'IsAdmin']);

require __DIR__ . '/auth.php';