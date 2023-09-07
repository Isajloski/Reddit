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
use Inertia\Inertia;
use Inertia\Response;


class PostController extends Controller
{

    public function __construct(private readonly PostService $postService,
                                private readonly CommunityService $communityService,
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

    public function paginate(){

        $posts = $this->getUserPosts()->paginate(2);


        $updatedPosts = $posts->getCollection()->map(function($post) {
                return [
                    $this->postMapper->mapToDto($post)
                ];
            });


        $posts->setCollection($updatedPosts);

        return $posts;
    }

    public function deleteVotePost($postId){
        $user = Auth::user();
        return $this->voteService->deletePostVote($user->id, $postId);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('MakePost');
    }

    public function sortByPopular()
    {
        return $this->postMapper->mapCollectionToDto($this->postService->getMostPopularPosts());
    }

    public function sortByNewest()
    {
        return $this->postMapper->mapCollectionToDto($this->postService->getNewestPosts());
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
            'image' => 'nullable|file'
        ]);

        $user = Auth::user();
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->image_id = null;

        $post->user()->associate($user);
        $post->community()->associate($request->input('communityId'));
        $post->save();

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */



    public function get(int $id)
    {
        return $this->postService->getById($id);
    }

    public function getRecentPosts(): Collection
    {
        return $this->postService->getRecentPosts();
    }

    public function getUserPosts() {
        $user = Auth::user();
        $communityIds = $this->communityService->getUserCommunities($user)->map(function ($community) {
            return $community->id;
        });
        return Post::whereIn('community_id', $communityIds);
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

    public function votePost($id, Request $request){
        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $postVoteDto = new PostVoteDto();
        $postVoteDto->post_id = $id;
        $postVoteDto->vote = $jsonData['vote'];

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
