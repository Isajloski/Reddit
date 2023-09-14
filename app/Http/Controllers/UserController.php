<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User\UserStatus;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    protected $userService;
    protected $commentService;
    protected $postService;

    public function __construct(UserService $userService, CommentService $commentService, PostService $postService)
    {
        $this->userService = $userService;
        $this->commentService = $commentService;
        $this->postService = $postService;
    }

    public function setting(){
        $user = Auth::user();

        return Inertia::render('Setting', [
            'user' => $user
        ]);
    }

    public function getById($id){
        $userService = new UserService();
    }



    public function getUserByName($name){

        $user = $this->userService->getUserByName($name);
        $comments = $this->commentService->getAllCommentsByUserId($user->id);
        $posts = $this->postService->getAllPostsByUserId($user->id);
        $combined = $comments->concat($posts);
        $sortedCombined = $combined->sortByDesc('created_at');
        //CommunityController->paginateCommunityPosts

        return Inertia::render('User', [
            'user' => [$user],
            'posts' => $sortedCombined,
        ]);

    }

}
