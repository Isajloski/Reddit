<?php

namespace App\Http\Controllers;

use App\Models\Community\Follow;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function paginateUserPosts(string $userName, Request $request){
        $user = $this->userService->getUserByName($userName);

        $jsonData = json_decode($request->getContent(), true);

        $sortBy = $jsonData['sort'];

        if($sortBy=="new"){
            $posts = $this->postService->getAllPostsByUserId($user->id)->paginate(2);
        }

        else{

            $posts = DB::table('posts')
                ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')
                ->select('posts.*', DB::raw('SUM(CASE WHEN post_votes.vote = 1 THEN 1 ELSE 0 END) as karma'))
                ->where('posts.user_id', $user->id)
                ->groupBy('posts.id')
                ->orderByDesc('karma')
                ->paginate(2);
        }



        $updatedPosts = $posts->getCollection()->map(function($post) {
            $postGet = \App\Models\Post\Post::query()
                ->where('id','=', $post->id)
                ->first();
            return
                $this->postMapper->mapToDto($postGet);
        });


        $posts->setCollection($updatedPosts);

        return $posts;
    }

    public function getUseFollowingCommunity($communityId){
        $user = Auth::user();

        return Follow::where('user_id', $user->id)->where('community_id',$communityId )->get();

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
