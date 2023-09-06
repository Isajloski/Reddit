<?php

namespace App\Mappers;

use App\Models\Comment\Comment;
use App\Models\Comment\dto\CommentDto;
use App\Models\User;
use App\Models\Vote\CommentVote;
use App\Services\VoteService;
use Illuminate\Support\Facades\Auth;

class CommentMapper
{

    public function __construct(private readonly UserMapper $userMapper,
    private readonly VoteService $voteService){}

    public function mapToDto(Comment $comment): CommentDto
    {
        $positiveVotes = CommentVote::all()->where('comment_id', $comment->id)
            ->where('vote', 1)->count();

        $negativeVotes = CommentVote::all()->where('comment_id', $comment->id)
            ->where('vote', 0)->count();

        $karma = $positiveVotes - $negativeVotes;

        $user = User::all()->find($comment->user_id);
        $AuthUser = Auth::user();
        $vote = $this->voteService->getCommentVotesByIds($AuthUser->id, $comment->id);

        $userDto = $this->userMapper->mapToDto($user);
        $commentDto = new CommentDto();
        $commentDto->setUserDto($userDto);
        $commentDto->setId($comment->id);
        $commentDto->setDate($comment->created_at);
        $commentDto->setParentCommentId($comment->parent_comment_id);
        $commentDto->setPostId($comment->post_id);
        $commentDto->setBody($comment->body);
        $commentDto->setKarma($karma);

        if($vote==null)
            $commentDto->setVote($vote);
        else{
            $commentDto->setVote($vote->vote);
        }

        $replies = Comment::where('parent_comment_id', $comment->id)->count();

        $commentDto->setRepliesNumber($replies);

        return $commentDto;
    }

    public function mapCollectionToDto($comments)
    {
    }

}
