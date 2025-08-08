<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'list'])->name('index');

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/movie/{$id}', [MovieController::class, 'show'])->name('movie.show');

Route::prefix('/movie')->group(function () {
    Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/add', [MovieController::class, 'store'])->name('movie.store');
    Route::post('/edit', [MovieController::class, 'edit'])->name('movie.edit');
    Route::post('/update/{id}', [MovieController::class, 'update'])->name('movie.update');
    Route::post('/destroy/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
})->middleware(['auth', 'verified', 'IsAdmin']);

Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');

Route::prefix('/category')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
})->middleware(['auth', 'verified', 'IsAdmin']);

require __DIR__.'/auth.php';