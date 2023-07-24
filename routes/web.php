<?php

use App\Http\Controllers\FlairController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\test;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CommunityController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'create', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('markdown', MarkdownController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);


//Comunities:
Route::get('/makeCommunity', [CommunityController::class, 'index'])->name('communities.index');
Route::post('/makeCommunity', [CommunityController::class, 'store'])->name('communities.store');
Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
Route::get('/communities/{id}', [CommunityController::class, 'findById'])->name('communities.findById');
Route::get('/communities/{id}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
Route::post('/communities/{id}/edit', [CommunityController::class, 'update'])->name('communities.update');
Route::post('/communities/{id}/delete', [CommunityController::class, 'destroy'])->name('communities.destroy');

//test
Route::get('/community', [test::class, 'index'])->name('test.index');

//post
Route::get('/makePost', [PostController::class, 'create'])->name('posts.create');
Route::post('/makePost', [PostController::class, 'store'])->name('posts.store');

//FLAIR
Route::post('/flair/{id}/delete', [FlairController::class, 'destroy'])->name('flair.destroy');
Route::post('/flair/{id}/edit', [FlairController::class, 'update'])->name('flair.update');

Route::post('/flair/create', [FlairController::class, 'store'])->name('flair.create');




require __DIR__.'/auth.php';
