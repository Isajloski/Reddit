<?php

namespace App\Http\Controllers;

use App\Mappers\CommentMapper;
use App\Models\Comment\Comment;
use App\Models\Vote\dto\CommentVoteDto;
use App\Services\CommentService;
use App\Services\VoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService,
                                private readonly CommentMapper $commentMapper,
                                private readonly VoteService $voteService) {}


    public function getPostComments($id){
        return $this->commentService->getPostComments($id);
    }

    public function getCommentReplies($id){
        return $this->commentService->getCommentReplies($id);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $comment = new Comment();
        $comment->user_id = $user->id;

        if(isset($jsonData['post_id']))
            $comment->post_id = $jsonData['post_id'];

        if(isset($jsonData['parent_comment_id']))
            $comment->parent_comment_id = $jsonData['parent_comment_id'];

        $comment->body = $jsonData['body'];

        $comment->save();

        $commentDto = $this->commentMapper->mapToDto($comment);

        return [$commentDto];

    }

    public function edit(Request $request, $id){
        $comment = Comment::find($id);
        $jsonData = json_decode($request->getContent(), true);
        $comment->body = $jsonData['body'];

        $comment->save();

        return $comment;
    }

//    public function vote(Request $request, int $id){
//
//        $user = Auth::user();
//
//        $jsonData = json_decode($request->getContent(), true);
//
//        $commentVoteDto = new CommentVoteDto();
//        $commentVoteDto->id = $jsonData['id'];
//        $commentVoteDto->vote = $jsonData['vote'];
//
//        return $this->commentService->vote($commentVoteDto, $user);
//
//    }

    public function vote(Request $request, int $id){

        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $commentVoteDto = new CommentVoteDto();
        $commentVoteDto->id = $jsonData['id'];
        $commentVoteDto->vote = $jsonData['vote'];

        $userKarmaController = new UserKarmaController();
        $comment = $this->commentService->getById($id);


        if($commentVoteDto->vote == 1){
            $userKarmaController->upVote($comment->user_id);
        }else if($commentVoteDto->vote == null){
            $userKarmaController->downVote($comment->user_id);

        }

        return $this->commentService->vote($commentVoteDto, $user);

    }

//
//    public function deleteVote($id){
//        $user = Auth::user();
//        return $this->voteService->deleteCommentVote($user->id, $id);
//    }

    public function deleteVote($id){
        $user = Auth::user();

        $userKarmaController = new UserKarmaController();
        $comment = $this->commentService->getById($id);
        $karma = $this->voteService->getCommentVotesByIds($user->id, $comment->id)->vote;


        if($karma == 0){
            $userKarmaController->upVote($comment->user_id);
        }else{
            $userKarmaController->downVote($comment->user_id);
        }


        return $this->voteService->deleteCommentVote($user->id, $id);
    }


    public function delete($commentId){
        Comment::destroy($commentId);
    }
}
