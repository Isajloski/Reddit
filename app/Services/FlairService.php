<?php

namespace App\Services;


use App\Models\Flair\Flair;

class FlairService
{

    public function getCommunitiesFlairs($communityId){
        return Flair::where('community_id', $communityId)->get()->toArray();
    }
}
