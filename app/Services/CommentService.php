<?php

namespace App\Services;

use App\Models\Comment\Comment;
use App\Models\Comment\dto\CommentCreationRequest;
use App\Models\Comment\dto\CommentUpdateRequest;
use App\Models\User;
use App\Models\Vote\dto\CommentVoteDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentService
{

    public function getPostComments(int $postId){
//        return Comment::with('user')->where('post_id', '=', $postId);
        return Comment::all();
    }


    public function getCommentReplies(int $commentId){
        return Comment::with('user')->where('parent_comment_id', '=', $commentId);
    }

    public function countCommentReplies(int $postId){
        return Comment::with('user')->where('parent_comment_id', '=', $postId)->count();
    }

    public function getComment(int $commentId){
        return Comment::with('user')->find($commentId);
    }

    public function save(CommentCreationRequest $commentCreationRequest){
        $user = Auth::user();

        $comment = new Comment();
        $comment->body = $commentCreationRequest->body;
        $comment->post_id = $commentCreationRequest->post_id;
        $comment->parent_comment_id = $commentCreationRequest->parent_comment_id;
        $comment->user_id = $user->id;

        $comment->save();

    }

    public function edit(CommentUpdateRequest $commentUpdateRequest){
        $comment = Comment::with('user')->find($commentUpdateRequest->comment_id);
        $comment->body = $commentUpdateRequest->body;

        $comment->save();
    }

    public function vote(CommentVoteDto $commentVoteDto, User $user){
        DB::table('comment_votes')->insert(
            ['user_id' => $user->id, 'comment_id' => $commentVoteDto->id, 'vote' => $commentVoteDto->vote]
        );

        $comment = Comment::with('user')->find($commentVoteDto->id);
        if($commentVoteDto->vote==1){
            $comment->karma = $comment->karma+=1;
        }
        else{
            $comment->karma = $comment->karma-=1;
        }

        $comment->save();
    }

    public function newest(){

    }

    public function popular(){

    }

    public function delete(int $commentId): void
    {
        //delete comment and delete replies
        Comment::destroy($commentId);
        $this->getCommentReplies($commentId)->delete();
    }

}
