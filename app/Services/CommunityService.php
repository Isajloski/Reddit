<?php

namespace App\Services;

use App\Models\Community\Community;
use App\Models\Community\dto\CommunityCardDto;
use App\Models\Community\Follow;
use App\Models\Post\Post;
use App\Models\User\User;

class CommunityService
{

    public function __construct(private readonly FlairService $flairService) {}

    public function getUserCommunities(User $user){
        return Follow::with('community')->where('user_id', $user->id)->get();
    }

    public function searchCommunities(){

    }

    public function getTotalUsers($id){
        return Follow::with('community')->where('community_id',$id)->count();
    }

    public function getActiveUsers($id){
        return Post::with('user')->where('community_id', $id)->count();
    }

    public function getAllCommunities(){
        return Community::all();
    }

    public function getCommunityCard($id)
    {
        $community = Community::with('user', 'flairs', 'image')->find($id);
        $cardDto = new CommunityCardDto();
        $cardDto->name = $community->name;
        $cardDto->id = $community->id;
        $cardDto->about = $community->description;
        $cardDto->rules = $community->rules;
        $cardDto->activeUsers = $this->getActiveUsers($id);
        $cardDto->totalUsers = $this->getTotalUsers($id);
        $cardDto->flairs = $this->flairService->getCommunitiesFlairs($community->id);

        return [$cardDto];
    }

    public function getCommunityDescription($id){
        return Community::find($id)->description;
    }

    public function getCommunityRules($id){
        return Community::find($id)->rules;
    }

}
