<?php

namespace App\Services;

use App\Mappers\CommentMapper;
use App\Models\Comment\Comment;
use App\Models\Comment\dto\CommentCreationRequest;
use App\Models\Comment\dto\CommentUpdateRequest;
use App\Models\User;
use App\Models\Vote\CommentVote;
use App\Models\Vote\dto\CommentVoteDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentService
{


    public function __construct(private readonly CommentMapper $commentMapper,
                                private readonly VoteService $voteService) {}


    public function getPostComments(int $postId)
    {

        $comments =  Comment::with('user')->where('post_id', '=', $postId)->get();

        return $comments->map(function ($comment) {

            return $this->commentMapper->mapToDto($comment);
        });

    }

    public function getCommentReplies($commentId){

        $comments =  Comment::with('user')->where('parent_comment_id', '=', $commentId)->get();

        return $comments->map(function ($comment) {

            return $this->commentMapper->mapToDto($comment);
        });
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

        $commentVote = $this->voteService->getCommentVotesByIds($user->id, $commentVoteDto->id);

        if($commentVote != null){
            $this->voteService->deleteCommentVote($user->id, $commentVoteDto->id);
        }
        $commentVoteNew = new CommentVote();
        $commentVoteNew->user_id = $user->id;
        $commentVoteNew->comment_id = $commentVoteDto->id;
        $commentVoteNew->vote = $commentVoteDto->vote;


        $commentVoteNew->save();

        return $this->voteService->getCommentKarma($commentVoteDto->id);
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
