<?php

namespace App\Mappers;

use App\Models\Comment\Comment;
use App\Models\Comment\dto\CommentDto;
use App\Models\User;
use App\Services\CommentService;

class CommentMapper
{

    public function __construct(private readonly UserMapper $userMapper, private readonly CommentService $commentService)
    {
    }


    public function mapToDto(Comment $comment)
    {
        $user = User::with('image')->find($comment->user_id);
        $userDto = $this->userMapper->mapToDto($user);
        $commentDto =  new CommentDto();
        $commentDto->setUserDto($userDto);
        $commentDto->setId($comment->id);
        $commentDto->setParentCommentId($comment->parent_comment_id);
        $commentDto->setPostId($comment->postId);
        $commentDto->setBody($comment->body);
        $commentDto->setKarma($comment->karma);
        $commentDto->setRepliesNumber($this->commentService->countCommentReplies($comment->id));

        return $commentDto;
    }

    public function mapCollectionToDto($comments)
    {
    }

}
