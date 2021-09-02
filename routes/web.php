<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PortfolioPagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/index', [PagesController::class, 'index'])->name('home');

// Admin routes

Route::prefix('admin')->group(function () {

    // Admin Portfolio

    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/list', [AdminController::class, 'list'])->name('admin.list');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

});

// User Routes

Route::get('/user/portfolios/create', [PortfolioPagesController::class, 'create'])->name('user.portfolios.create');
Route::put('/user/portfolios/create', [PortfolioPagesController::class, 'store'])->name('user.portfolios.store');
Route::get('/user/portfolios/list', [PortfolioPagesController::class, 'list'])->name('user.portfolios.list');
Route::get('/user/portfolios/edit/{id}', [PortfolioPagesController::class, 'edit'])->name('user.portfolios.edit');
Route::post('user/portfolios/update/{id}', [PortfolioPagesController::class, 'update'])->name('user.portfolios.update');
Route::delete('user/portfolios/destroy/{id}', [PortfolioPagesController::class, 'destroy'])->name('user.portfolios.destroy');
Route::get('/user/portfolios/like/{id}', [PortfolioPagesController::class, 'like'])->name('user.portfolios.like');

// User Profile Routes

Route::get('/user/profile', [PortfolioPagesController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [PortfolioPagesController::class, 'editProfile'])->name('user.profile.edit');
Route::post('user/profile/update', [PortfolioPagesController::class, 'updateProfile'])->name('user.profile.update');

// Comment routes

Route::get('/user/comments/create/{post_id}', [CommentController::class, 'create'])->name('user.comments.create');
Route::post('/user/comments/create/{post_id}', [CommentController::class, 'store'])->name('user.comments.store');

// Search Route

Route::get('search', [PagesController::class, 'search'])->name('search');


// Authentication

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/redirects', [HomeController::class, 'index'])->name('index');

Route::get('logout', [HomeController::class, 'logout'])->name('logout');
