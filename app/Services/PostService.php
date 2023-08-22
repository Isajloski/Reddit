<?php

namespace App\Services;
use App\Mappers\PostMapper;
use App\Models\Post\dto\PostCreationDto;
use App\Models\Post\Post;
use App\Models\User;
use App\Models\Vote\dto\PostVoteDto;
use App\Models\Vote\PostVote;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(private readonly PostMapper $postMapper)
    {
    }

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

    public function vote_Post(PostVoteDto $postVoteDto, User $user): void
    {
        DB::table('post_votes')->insert(
            ['user_id' => $user->id, 'post_id' => $postVoteDto->post_id, 'vote' => $postVoteDto->vote]
        );
        $post = Post::with('image')->find($postVoteDto->post_id);
        if($postVoteDto->vote==1){
            $post->karma = $post->karma+=1;
        }
        else{
            $post->karma = $post->karma-=1;
        }

        $post->save();
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
}
