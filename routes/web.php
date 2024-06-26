<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//以下自分で書いたコード

Route::get('/', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class. 'create']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/week', [PostController::class, 'week'])->name('week');
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'delete']);

Route::get('/buy', [PostController::class, 'buy'])->name('buy');
Route::get('/makelist', [PostController::class, 'makeList'])->name('makelist');
Route::post('/makelist', [PostController::class, 'storelist']);
Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/posts/{post}/menu', [PostController::class, 'menu'])->name('menu');
Route::post('/posts/{post}/menu', [PostController::class, 'storemenu'])->name('storemenu');
Route::delete('/weeks/{id}', [PostController::class, 'deleteWeek'])->name('weeks.delete');

Route::post('/up_week_count', [PostController::class, 'up_week_count'])->name('up_week_count');
Route::post('/down_week_count', [PostController::class, 'down_week_count'])->name('down_week_count');

//以上自分で書いたコード

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
});

Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
