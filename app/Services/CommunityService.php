<?php

namespace App\Services;

use App\Models\Community;
use App\Models\Follow;
use App\Models\User;

class CommunityService
{

    public function getUserCommunities(User $user){
        return Follow::with('community')->where('user_id', $user->id)->get();
    }

    public function searchCommunities(){

    }

    public function getAllCommunities(){
        return Community::all();
    }

}
