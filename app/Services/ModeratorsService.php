<?php

namespace App\Services;

use App\Models\Community\Community;
use App\Models\Community\Moderators;
use Illuminate\Support\Facades\Log;

class ModeratorsService
{

    public function getCommunityModeratorsByCommunityId($community_id)
    {
        $moderators = Moderators::with('user')->where('community_id', $community_id)->get();
        return $moderators;
    }

    public function store($user_id, $community_id){
        $moderator = new Moderators([
            'user_id' => $user_id,
            'community_id' => $community_id
        ]);

        $community = Community::findOrFail($community_id);

        $community->moderators()->save($moderator);
    }

    public function destory($id)
    {
        return Moderators::destroy($id);
    }







}
