<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Vote\CommentVote;
use App\Models\Vote\PostVote;

class VoteService
{

    public function getPostKarma($postId){

        $positiveVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 1)->count();

        $negativeVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 0)->count();

        return $positiveVotes - $negativeVotes;

    }

    public function getCommentKarma($commmentId){

        $positiveVotes = CommentVote::all()->where('comment_id', $commmentId)
            ->where('vote', 1)->count();

        $negativeVotes = CommentVote::all()->where('comment_id', $commmentId)
            ->where('vote', 0)->count();

        return $positiveVotes - $negativeVotes;

    }

    public function getPersonVote($userId, $postId){

        $vote = $this->getPostVotesByIds($userId, $postId);

        if($vote == null) return null;
        else return $vote->vote;
    }

    public function getPersonCommentVote($userId, $commentId){

        $vote = $this->getCommentVotesByIds($userId, $commentId);

        if($vote == null) return null;
        else return $vote->vote;
    }

    public function getPostVotesByIds($userId, $postId){

        return PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->first();
    }

    public function getCommentVotesByIds($userId, $commentId){

        return CommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->first();
    }

    public function deletePostVote($userId, $postId){

        PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->delete();

        return $this->getPostKarma($postId);
    }

    public function deleteCommentVote($userId, $commentId){

        CommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->delete();

        return $this->getCommentKarma($commentId);
    }

}
