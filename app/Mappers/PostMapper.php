<?php

namespace App\Mappers;

use App\Models\Comment\Comment;
use App\Models\dto\CommunityDto;
use App\Models\dto\UserDto;
use App\Models\Post\dto\PostDetailedDto;
use App\Models\Post\dto\PostDto;
use App\Models\Post\Post;
use App\Services\VoteService;
use Illuminate\Support\Facades\Auth;

class PostMapper
{
    public function __construct(private readonly VoteService $voteService){}


    public function mapToDto(Post $post): PostDto
    {
        $karma = $this->voteService->getPostKarma($post->id);
        $comments_number = Comment::all()->where('post_id', $post->id)->count();
        $postDto =  new PostDto($post->id, $post->title, $post->body, $post->created_at, $karma, $comments_number);
        $communityDto = new CommunityDto($post->community_id, $post->community->name);
        $userDto = new UserDto($post->user_id, $post->user->name);
        $user = Auth::user();
        $voted = $this->voteService->getPersonVote($user->id, $post->id);
        $postDto->setVote($voted);
        $postDto->setCommunityDto($communityDto);
        $postDto->setUserDto($userDto);

        return $postDto;
    }

    public function mapToDetailedDto(Post $post): PostDetailedDto
    {

        $postDto =  new PostDetailedDto($post->id, $post->title, $post->body, $post->created_at, $post->karma, $post->comments_number);
        $communityDto = new CommunityDto($post->community_id, $post->community->name);
        $userDto = new UserDto($post->user_id, $post->user->name);
        $postDto->setCommunityDto($communityDto);
        $postDto->setUserDto($userDto);
        $postDto->setComments($post->comments);

        return $postDto;
    }

    public function mapCollectionToDto($posts)
    {
        return $posts->map(function ($post){
            return $this->mapToDto($post);
        });
    }
}
