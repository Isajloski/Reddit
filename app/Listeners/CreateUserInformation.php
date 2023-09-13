<?php

namespace App\Listeners;

use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserKarmaController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserInformation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;

        $userKarmaController = new UserKarmaController();
        $userKarmaController->store($user->id);

        $userStatusController = new UserStatusController();
        $userStatusController->store($user->id);

        $userInfoController = new UserInfoController();
        $userInfoController->store($user->id);
    }




}
