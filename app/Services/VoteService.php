<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Vote\PostVote;

class VoteService
{

    public function getPostVotes(){

    }


    public function getCommentVotes(){

    }

    public function getPostKarma($postId){

        $positiveVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 1)->count();

        $negativeVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 0)->count();

        return $positiveVotes - $negativeVotes;

    }

    public function getPersonVote($userId, $postId){

        $vote = $this->getByIds($userId, $postId);

        if($vote == null) return null;
        else return $vote->vote;
    }

    public function getByIds($userId, $postId){

        return PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->first();
    }

    public function delete($userId, $postId){

        PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->delete();

        return $this->getPostKarma($postId);
    }

}
