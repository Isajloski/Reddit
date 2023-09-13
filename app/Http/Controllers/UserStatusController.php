<?php

namespace App\Http\Controllers;

use App\Models\User\UserStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    //
    public function store($id)
    {
        UserStatus::create([
            'user_id' => $id,
            'active' => true,
            'activity' => Carbon::now()
        ]);
    }
}
