<?php

namespace App\Http\Controllers;

use App\Mappers\PostMapper;
use App\Models\Post\dto\PostCreationDto;
use App\Models\Post\Post;
use App\Models\Vote\dto\PostVoteDto;
use App\Services\PostService;
use App\Services\VoteService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use App\Policies\PostPolicy;



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


    public function getPostImage($id)
    {
        $image = $this->postService->getById($id)->image_id;
        $imageController = new ImageController();
        $path = $imageController->getImage($image);
        return $path->path;
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
                $this->postMapper->mapToDto($postGet);
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
        $post->flair_id = $request->input('flair');
        $post->spoiler = $request->boolean('spoiler');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageController = new ImageController();
            $imageId = $imageController->storeImage($file, '/posts');
            $post->image_id = $imageId;
        }
        else{
            $post->image_id = null;
        }


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

        $post = Post::with('user:id,id','image' )->find($id);

        $this->authorize('update', $post);

        return Inertia::render('Posts/EditPost', [
            'posts' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
//    public function update(PostCreationDto $postCreationDto): RedirectResponse
//    {
//        if (!auth()->check()) {
//            return redirect()->route('login');
//        }
//        $this->postService->edit($postCreationDto);
//
//        return redirect(route('posts.index'));
//
//    }

    public function update(Request $request, $id): RedirectResponse
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $post = $this->postService->getById($id);


        $this->authorize('update', $post);

        $user = Auth::user();
        $post->id =   $id;
        $post->title =   $request->input('title');
        $post->body =   $request->input('body');
        if($request->integer('flair') === 0) {
            $post->flair_id = null;
        }else{
            $post->flair_id = $request->integer('flair');

        }
        $post->spoiler = $request->boolean('spoiler');
        $old = $post->image_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageController = new ImageController();
            $imageId = $imageController->storeImage($file, '/posts');
            $post->image_id = $imageId;
            $post->user()->associate($user);
            $post->community()->associate($post->community_id);
            $post->save();
            if(!is_null($old)) {
                $imageController->delete($old);
            }
        }
        else {
            $post->user()->associate($user);
            $post->community()->associate($post->community_id);
            $post->save();
        }
        return redirect('/community/' . $post->community_id);
    }


    public function votePost($id, Request $request){
        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $postVoteDto = new PostVoteDto();
        $postVoteDto->post_id = $id;
        $postVoteDto->vote = $jsonData['vote'];


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

    public function delete($id)
    {

        $post = $this->postService->getById($id);
        $this->authorize('destroy', $post);

        $post = $this->postService->getById($id)->image_id;
        $this->postService->delete($id);


        if(!is_null($post)){
                $imageController = new ImageController();
                $imageController->delete($post);
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Post $post) : RedirectResponse
    {
        //
        $this->authorize('delete', $post);

        $post->delete();

        return redirect(route('posts.index'));
    }
}
