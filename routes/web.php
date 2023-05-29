<?php

use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('markdown', MarkdownController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

//Comunities:
Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
Route::post('/communities', [CommunityController::class, 'store'])->name('communities.store');
Route::get('/communities/{id}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
Route::put('/communities/{id}', [CommunityController::class, 'update'])->name('communities.update');
Route::delete('/communities/{id}', [CommunityController::class, 'destroy'])->name('communities.destroy');


require __DIR__.'/auth.php';
