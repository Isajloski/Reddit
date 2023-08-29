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
        $post = Post::with('image')->find($postId);
        $post->karma = $post->karma-1;
        $post->save();
        PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->delete();
        return $post->karma;
    }

}
