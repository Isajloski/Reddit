<?php

namespace App\Services;
use App\Mappers\PostMapper;
use App\Models\Community;
use App\Models\Post\dto\PostCreationDto;
use App\Models\Post\Post;
use App\Models\User;
use App\Models\Vote\dto\PostVoteDto;
use App\Models\Vote\PostVote;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function __construct(private readonly PostMapper $postMapper,
                                private readonly VoteService $voteService){}

    public function getById(int $id)
    {
        return Post::with('user','image','community', 'comments')->find($id);
    }

    public function edit(PostCreationDto $postCreationDto): void
    {
        $post = Post::with('image')->find($postCreationDto->id);
        $post->title = $postCreationDto->title;
        $post->body = $postCreationDto->body;

        $post->save();
    }

    public function vote_Post(PostVoteDto $postVoteDto, User $user)
    {

        $userr = Auth::user();

        $postVote = $this->voteService->getPostVotesByIds($user->id, $postVoteDto->post_id);

        if($postVote != null){
            $this->voteService->deletePostVote($user->id, $postVoteDto->post_id);
        }
        $postVoteNew = new PostVote();
        $postVoteNew->user_id = $userr->id;
        $postVoteNew->post_id = $postVoteDto->post_id;
        $postVoteNew->vote = $postVoteDto->vote;


        $postVoteNew->save();
        $post = Post::with('image')->find($postVoteDto->post_id);


        $post->save();

        return $this->voteService->getPostKarma($post->id);
    }

    public function delete(int $id): int
    {
        return Post::destroy($id);
    }

    public function getRecentPosts(): Collection
    {
        $posts = $this->getAllPosts();

        return $posts->map(function ($post) {
            return $this->postMapper->mapToDto($post);
        });
    }

    public function getNewestPosts(){

        $posts =  $this->getAllPosts();

        return $posts->sortBy('created_at');
    }

    public function getMostPopularPosts()
    {
        $posts = $this->getAllPosts();

        return $posts->sortBy('karma');
    }

    public function getAllPosts(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Post::with('user','image', 'community')->get();
    }

    public function getCommunityPosts(Community $community){
        return Post::where('community_id', $community->id)->get();
    }
}
