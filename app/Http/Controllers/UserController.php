<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User\UserStatus;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function setting(){
        $user = Auth::user();

        Log::info($user);
        return Inertia::render('Setting', [
            'user' => $user
        ]);
    }

    public function getById($id){
        $userService = new UserService();
    }



    public function getUserByName($name){

        $user = $this->userService->getUserByName($name);

        return Inertia::render('User', [
            'user' => [$user],
        ]);

    }

}
