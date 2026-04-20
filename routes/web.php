<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    
    // Message routes
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::post('messages/{id}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
    Route::post('messages/{id}/mark-unread', [MessageController::class, 'markAsUnread'])->name('messages.mark-unread');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
