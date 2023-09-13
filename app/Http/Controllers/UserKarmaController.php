<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Models\User\UserKarma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKarmaController extends Controller
{
    //
    public function store($userId)
    {

        $userKarma = new UserKarma([
            'user_id' => $userId,
            'karma' => 1,
        ]);

        // Associate the UserKarma record with the specified user
        User::find($userId)->karma()->save($userKarma);
        return redirect()->route('dashboard');
    }

    public function upVote($userId)
    {
        $user = User::findOrFail($userId);

        $user->karma->increment('karma');

        return response()->json(['message' => 'Upvoted successfully.']);
    }

    public function downVote($userId)
    {
        $user = User::findOrFail($userId);

        $user->karma->decrement('karma');

        return response()->json(['message' => 'Downvoted successfully.']);
    }

    public function delete($userId){

    }

}
