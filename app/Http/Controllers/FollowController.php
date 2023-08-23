<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Log;


class FollowController extends Controller
{
    //
    public function follow($communityId)
    {

        $user = auth()->user();

        if (!$communityId) {
            return response()->json(['message' => 'Invalid community ID.'], 400);
        }

        $follow = new Follow([
            'user_id' => $user->id,
            'community_id' => $communityId,
        ]);

        $follow->save();

        return response()->json(['message' => 'You are now following the community.']);
    }


    public function unfollow($communityId)
    {
        $user = auth()->user(); // Assuming you have authentication set up

        $follow = Follow::where([
            'user_id' => $user->id,
            'community_id' => $communityId,
        ])->first();

        if ($follow) {
            $follow->delete();
            return response()->json(['message' => 'You have unfollowed the community.']);
        } else {
            return response()->json(['message' => 'You were not following the community.']);
        }
    }


}
