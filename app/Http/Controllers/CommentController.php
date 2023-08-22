<?php

namespace App\Http\Controllers;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {
    }


    public function getPostComments($id){
        return $this->commentService->getPostComments($id);
    }

    public function getCommentReplies($id){
        return $this->commentService->getCommentReplies($id);
    }
}
