<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FlairController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\ModeratorsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInfoController;
use http\Client\Request;
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
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [UserInfoController::class, 'bio'])->name('profile.bio');
    Route::post('/profile', [UserInfoController::class, 'image'])->name('profile.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
});

    Route::resource('posts', PostController::class)
    ->only(['index', 'create', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


Route::prefix('community')->middleware(['user.activity','auth'])->group(function () {
    Route::get('/image/{id}', [CommunityController::class, 'getCommunityImage'])->name('communities.getCommunityImage');
    Route::post('/{id}/paginate', [CommunityController::class, 'paginateCommunityPosts'])->name('communities.paginate');
    Route::get('/create', [CommunityController::class, 'createEditForm'])->name('communities.createEditForm');
    Route::post('/create', [CommunityController::class, 'store'])->name('communities.store');
    Route::get('/{id}', [CommunityController::class, 'renderById'])->name('communities.renderById');
    Route::get('/{id}/card', [CommunityController::class, 'getCard'])->name('communities.getCard');
    Route::get('/{id}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
    Route::get('/{id}/rules', [CommunityController::class, 'rules'])->name('communities.rules');
    Route::get('/{id}/description', [CommunityController::class, 'description'])->name('communities.description');
    Route::post('/{id}/edit', [CommunityController::class, 'update'])->name('communities.update');
    Route::post('/{id}/delete', [CommunityController::class, 'destroy'])->name('communities.destroy');
    Route::get('/user/following', [CommunityController::class, 'userCommunities'])->name('communities.userCommunities');
    Route::post('/moderator/create', [ModeratorsController::class, 'store'])->name('moderators.store');
    Route::post('/moderator/{id}/delete', [ModeratorsController::class, 'destory'])->name('moderators.destory');
    Route::get('/moderator/{id}', [ModeratorsController::class, 'getModeratorsById'])->name('moderators.getModeratorsById');
});

Route::prefix('post')->middleware(['user.activity','auth'])->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{id}', [PostController::class, 'get']) ->name('posts.get');
    Route::post('/{id}/vote', [PostController::class, 'votePost']) ->name('posts.votePost');
    Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/{id}/edit', [PostController::class, 'edit']) ->name('posts.edit');
    Route::post('/{id}/edit', [PostController::class, 'update']) ->name('posts.update');
    Route::delete('/{id}/vote/delete', [PostController::class, 'deleteVotePost'])->name('posts.deleteVotePost');
    Route::get('/{id}/comments', [CommentController::class, 'getPostComments'])->name('posts.getPostComments');
    Route::get('/{id}/comments/sort/newest', [CommentController::class, 'sortByNewest'])->name('comments.sortByNewest');
    Route::get('/{id}/comments/sort/popular', [CommentController::class, 'sortByPopular'])->name('comments.sortByPopular');
});

Route::prefix('posts')->middleware(['auth'])->group(function () {
    Route::get('/image/{id}', [PostController::class, 'getPostImage'])->name('image.getPostImage');
    Route::post('/following/paginate', [PostController::class, 'paginateFollowingPosts'])->name('posts.paginate');
    Route::post('/trending/paginate', [PostController::class, 'paginateTrendingPosts'])->name('posts.paginate');
});


Route::prefix('flair')->middleware(['auth'])->group(function () {
    Route::get('/community/{id}', [FlairController::class, 'getCommunityFlairs'])->name('flair.communityFlairs');
    Route::post('/{id}/delete', [FlairController::class, 'destroy'])->name('flair.destroy');
    Route::post('/{id}/edit', [FlairController::class, 'update'])->name('flair.update');
    Route::post('/create', [FlairController::class, 'store'])->name('flair.create');
});



Route::prefix('comment')->middleware(['auth'])->group(function () {
    Route::get('/image/{id}', [CommentController::class, 'getCommentUserImage'])->name('comments.getCommentUserImage');
    Route::get('/{id}/replies', [CommentController::class, 'getCommentReplies'])->name('comments.getCommentReplies');
    Route::post('/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::delete('/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');
    Route::post('/{id}/vote', [CommentController::class, 'vote'])->name('comments.vote');
    Route::delete('/{id}/vote/delete', [CommentController::class, 'deleteVote'])->name('comments.deleteVote');
    Route::post('/create', [CommentController::class, 'create'])->name('comments.create');
});


Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/get/current', [UserController::class, 'getCurrentUser'])->name('users.currentUser');
    Route::post('/{userName}/paginate', [UserController::class, 'paginateUserPosts'])->name('user.paginate');
    Route::get('/{name}', [UserController::class, 'getUserByName'])->name('users.getUserByName');
    Route::get('/following/{communityId}', [UserController::class, 'getUseFollowingCommunity'])->name('users.getUseFollowingCommunity');
    Route::post('/image', [UserInfoController::class, 'uploadImage'])->name('infos.uploadImage');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/active', [UserController::class, 'active'])->name('user.active');
    Route::get('/image/{id}', [ImageController::class, 'getImage'])->name('image.getImage');
    Route::post('/follow/{communityId}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{communityId}', [FollowController::class, 'unfollow'])->name('unfollow');

});


require __DIR__.'/auth.php';
