<?php

namespace App\Services;
use App\Mappers\PostMapper;
use App\Models\Community\Community;
use App\Models\Post\dto\PostCreationDto;
use App\Models\Post\Post;
use App\Models\User\User;
use App\Models\Vote\dto\PostVoteDto;
use App\Models\Vote\PostVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(private readonly CommunityService $communityService,
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


    public function getAllPosts(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Post::with('user','image', 'community')->get();
    }

    public function getFollowingPosts() {
        $user = Auth::user();
        $communityIds = $this->communityService->getUserCommunities($user)->map(function ($community) {
            return $community->id;
        });
        return Post::whereIn('community_id', $communityIds);
    }

    public function getTrendingPosts() {
        return DB::table('posts')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select('posts.*', DB::raw('COUNT(comments.id) as comment_count'))
            ->groupBy('posts.id')
            ->orderByDesc('comment_count');
    }

    public function getCommunityPosts(Community $community){
        return Post::where('community_id', $community->id);
    }
}
