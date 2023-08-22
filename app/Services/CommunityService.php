<?php

namespace App\Services;

use App\Models\Community;

class CommunityService
{

    public function getUserCommunities(){

    }

    public function searchCommunities(){

    }

    public function getAllCommunities(){
        return Community::all();
    }

}
