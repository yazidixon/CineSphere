<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\CommentController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Profile
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
Route::get('/admin/verify-code', function () {
    return view('verify_admin_code');
})->middleware('auth')->name('admin.verify_code_form');
Route::post('/admin/verify-code', [App\Http\Controllers\ProfileController::class, 'verifyAdminCode'])->middleware('auth')->name('admin.verify_code');

// Movies
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->middleware('auth')->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->middleware('auth')->name('movies.store');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->middleware('auth')->name('movies.edit');
Route::post('/movies/{id}', [MovieController::class, 'update'])->middleware('auth')->name('movies.update');
Route::post('/movies/{id}/delete', [MovieController::class, 'destroy'])->middleware('auth')->name('movies.destroy');
Route::post('/movies/{id}/rate', [MovieController::class, 'rate'])->middleware('auth')->name('movies.rate');

// Comments
Route::post('/movies/{id}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');
Route::post('/comments/{id}/vote', [App\Http\Controllers\CommentController::class, 'vote'])->middleware('auth')->name('comments.vote');

// Static pages
Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');

// OMDb search
Route::get('/omdb', [MovieController::class, 'omdbSearch'])->name('omdb.search');

// 404 fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
