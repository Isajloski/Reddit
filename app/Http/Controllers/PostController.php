<?php

namespace App\Http\Controllers;

use App\Mappers\PostMapper;
use App\Models\Post\dto\PostCreationDto;
use App\Models\Post\Post;
use App\Models\Vote\dto\PostVoteDto;
use App\Services\CommunityService;
use App\Services\PostService;
use App\Services\VoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;


class PostController extends Controller
{

    public function __construct(private readonly PostService $postService,
                                private readonly VoteService $voteService,
                                private readonly PostMapper $postMapper) {}


    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::with('user:id,name')->latest()->get(),
        ]);
    }


    public function paginateFollowingPosts(Request $request){


        $jsonData = json_decode($request->getContent(), true);

        $sortBy = $jsonData['sort'];

        if($sortBy=="new"){
            $posts = $this->postService->getFollowingPosts()->orderBy('created_at', 'desc')->paginate(2);
        }
        else{
            $posts = DB::table('posts')
                ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')
                ->select('posts.*', DB::raw('SUM(CASE WHEN post_votes.vote = 1 THEN 1 ELSE 0 END) as karma'))
                ->groupBy('posts.id')
                ->orderByDesc('karma')
                ->paginate(2);

        }

        $updatedPosts = $posts->getCollection()->map(function($post) {

            $postGet = \App\Models\Post\Post::query()
                ->where('id','=', $post->id)
                ->first();
            return
                $this->postMapper->mapToDto($postGet)
            ;
        });


        $posts->setCollection($updatedPosts);

        return $posts;
    }

    public function paginateTrendingPosts(Request $request){


        $jsonData = json_decode($request->getContent(), true);

        $sortBy = $jsonData['sort'];

        if($sortBy=="new"){
            $posts = $this->postService->getTrendingPosts()
                ->orderBy('created_at', 'desc')->paginate(2);
        }
        else{
            $posts = $this->postService->getTrendingPosts()
                ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')
                ->select('posts.*', DB::raw('SUM(CASE WHEN post_votes.vote = 1 THEN 1 ELSE 0 END) as karma'))
                ->groupBy('posts.id')
                ->orderByDesc('karma')
                ->paginate(2);

        }

        $updatedPosts = $posts->getCollection()->map(function($post) {

            $postGet = \App\Models\Post\Post::query()
                ->where('id','=', $post->id)
                ->first();
            return
                $this->postMapper->mapToDto($postGet)
                ;
        });


        $posts->setCollection($updatedPosts);

        return $posts;
    }

//    public function deleteVotePost($postId){
//        $user = Auth::user();
//        return $this->voteService->deletePostVote($user->id, $postId);
//    }

    public function deleteVotePost($postId){
        $user = Auth::user();
        $userKarmaController = new UserKarmaController();
        $post = $this->postService->getById($postId);

        $karma = $this->voteService->getPostVotesByIds($user->id, $postId)->vote;

        if($karma == 0){
            $userKarmaController->upVote($post->user_id);
        }else{
            $userKarmaController->downVote($post->user_id);
        }

        return $this->voteService->deletePostVote($user->id, $postId);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('MakePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'communityId' => 'required',
            'image' => 'nullable|file',
            'flair' => 'nullable|integer'
        ]);

        $user = Auth::user();
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->image_id = null;
        $post->flair_id = $request->input('flair');

        $post->user()->associate($user);
        $post->community()->associate($request->input('communityId'));
        $post->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */

    public function get(int $id)
    {
        return $this->postService->getById($id);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return Inertia::render('Posts/Edit', [
            'posts' => Post::with('post:id')->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCreationDto $postCreationDto): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->postService->edit($postCreationDto);

        return redirect(route('posts.index'));

    }

//    public function votePost($id, Request $request){
//        $user = Auth::user();
//
//        $jsonData = json_decode($request->getContent(), true);
//
//        $postVoteDto = new PostVoteDto();
//        $postVoteDto->post_id = $id;
//        $postVoteDto->vote = $jsonData['vote'];
//
//        return $this->postService->vote_Post($postVoteDto, $user);
//
//    }

    public function votePost($id, Request $request){
        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $postVoteDto = new PostVoteDto();
        $postVoteDto->post_id = $id;
        $postVoteDto->vote = $jsonData['vote'];
//
//        $vote = $jsonData['vote'];


        $userKarmaController = new UserKarmaController();
        $post = $this->postService->getById($id);

        //        $userKarmaController->downVote($post->user_id);

        if($postVoteDto->vote == 1){
            $userKarmaController->upVote($post->user_id);
        }else if($postVoteDto->vote == null){
            $userKarmaController->downVote($post->user_id);

        }

        return $this->postService->vote_Post($postVoteDto, $user);

    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(int $id)
    {
        return $this->postService->delete($id);

    }

    public function destroy(Post $post) : RedirectResponse
    {
        //
        $this->authorize('delete', $post);

        $post->delete();

        return redirect(route('posts.index'));
    }
}
