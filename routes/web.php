<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FlairController;
use App\Http\Controllers\FollowController;
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
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'create', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('markdown', MarkdownController::class)
    ->only(['index']);


Route::prefix('communities')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('communities.index');
    Route::get('/{id}', [CommunityController::class, 'findById'])->name('communities.findById');
    Route::get('/{id}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
    Route::post('/{id}/edit', [CommunityController::class, 'update'])->name('communities.update');
    Route::post('/{id}/delete', [CommunityController::class, 'destroy'])->name('communities.destroy');
    Route::post('/{id}/delete', [CommunityController::class, 'destroy'])->name('communities.destroy');
    Route::get('/user/following', [CommunityController::class, 'userCommunities'])->name('communities.userCommunities');

});
Route::get('/makeCommunity', [CommunityController::class, 'index'])->name('communities.index');
Route::post('/makeCommunity', [CommunityController::class, 'store'])->name('communities.store');

//post
Route::get('/makePost', [PostController::class, 'create'])->name('posts.create');
Route::post('/makePost', [PostController::class, 'store'])->name('posts.store');

Route::prefix('post')->group(function () {
    Route::get('/{id}', [PostController::class, 'get']) ->name('posts.get');
    Route::post('/{id}/vote', [PostController::class, 'votePost']) ->name('posts.votePost');
    Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/{id}/edit', [PostController::class, 'edit']) ->name('posts.edit');
    Route::post('/{id}/edit', [PostController::class, 'update']) ->name('posts.update');
    Route::delete('/{id}/vote/delete', [PostController::class, 'deleteVotePost'])->name('posts.deleteVotePost');
    Route::get('/{id}/comments', [CommentController::class, 'getPostComments'])->name('posts.getPostComments');

});


Route::get('/posts/sort/popular', [PostController::class, 'sortByPopular'])->name('posts.sortByPopular');
Route::get('/posts/sort/newest', [PostController::class, 'sortByNewest'])->name('posts.sortByNewest');
Route::get('/posts/recent', [PostController::class, 'getRecentPosts'])->name('posts.getRecentPosts');
Route::get('/posts/paginate', [PostController::class, 'paginate'])->name('posts.paginate');


Route::post('/flair/{id}/delete', [FlairController::class, 'destroy'])->name('flair.destroy');
Route::post('/flair/{id}/edit', [FlairController::class, 'update'])->name('flair.update');

Route::post('/flair/create', [FlairController::class, 'store'])->name('flair.create');


Route::post('/follow/{communityId}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{communityId}', [FollowController::class, 'unfollow'])->name('unfollow');


Route::prefix('comment')->group(function () {
    Route::get('/{id}/replies', [CommentController::class, 'getCommentReplies'])->name('comments.getCommentReplies');
    Route::post('/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::delete('/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');
    Route::post('/{id}/vote', [CommentController::class, 'vote'])->name('comments.vote');
    Route::delete('/{id}/vote/delete', [CommentController::class, 'deleteVote'])->name('comments.deleteVote');
    Route::post('/write', [CommentController::class, 'create'])->name('comments.create');
});


Route::get('post/{id}/comments/sort/newest', [CommentController::class, 'sortByNewest'])->name('comments.sortByNewest');
Route::get('post/{id}/comments/sort/popular', [CommentController::class, 'sortByPopular'])->name('comments.sortByPopular');





require __DIR__.'/auth.php';
