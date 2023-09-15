<?php

namespace App\Services;

use App\Models\User\User;
use App\Models\User\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserService
{

    public function getLoggedInUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }

    private function userActivity($user) {
        if (!is_null($user->id)) {
            $userStatus = UserStatus::where('user_id', $user->id)->first();
            if (!is_null($userStatus)) {
                $userStatus->updateActiveStatus();
            }
        }

    }

    public function getUserById($userId)
    {
        return  User::with('karma','status','info')->where('id',$userId)->firstOrFail();
    }

    public function getUserByName($name){
        $user =  User::with('karma','status','info')->where('name', $name)->firstOrFail();
        $this->userActivity($user);
        return $user;
    }
}
