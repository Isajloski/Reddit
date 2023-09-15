<?php

namespace App\Http\Controllers;

use App\Mappers\CommunityMapper;
use App\Mappers\PostMapper;
use App\Models\User\UserStatus;
use App\Services\CommunityService;
use App\Services\FlairService;
use App\Services\ModeratorsService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModeratorsController extends Controller
{

    public function getModeratorsById($id){
        $moderatorService = new ModeratorsService();
        return $moderatorService->getCommunityModeratorsByCommunityId($id);
    }


    //
    public function store(Request $request){
        $moderatorService = new ModeratorsService();
        $userService = new UserService();

        $name = $request->input('name');
        $comunity_id = $request->input('community_id');

        $user = $userService->getUserByName($name);

        $moderatorService->store($user->id, $comunity_id );
    }

    public function destory($id){
        $moderatorService = new ModeratorsService();
        $moderatorService->destory($id);
    }


}
