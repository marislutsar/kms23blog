<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/pages/page1', [PublicController::class, 'page1'])->name('page1');
Route::get('/pages/page2', [PublicController::class, 'page2'])->name('page2');
Route::get('/post/{post}', [PublicController::class, 'post'])->name('post');
Route::get('/user/{user}', [PublicController::class, 'user'])->name('user');
Route::get('/tag/{tag}', [PublicController::class, 'tag'])->name('tag');
Route::get('/category/{category}', [PublicController::class, 'category'])->name('category');



// Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
// Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('/admin/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
// Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
// Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/secure', function () {
    return redirect()->route('home');
})->middleware(['password.confirm']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/admin/posts', PostController::class);

    Route::post('/post/{post}/comment', [PublicController::class, 'comment'])->name('comment');

    Route::post('/post/{post}/like', [PublicController::class, 'like'])->name('like');

    Route::post('/user/{user}/follow', [PublicController::class, 'follow'])->name('follow');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
