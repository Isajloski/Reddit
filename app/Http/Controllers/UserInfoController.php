<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Models\User\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\UserInfoService;

class UserInfoController extends Controller
{
    //
    public function store($userId)
    {
        $userInfo = new UserInfo([
            'user_id' => $userId,
            'image_id' => null,
            'bio' => ''
        ]);

        // Associate the UserKarma record with the specified user
        User::find($userId)->info()->save($userInfo);
        return redirect()->route('dashboard');
    }

    public function bio(Request $request){

        $id = Auth::user()->id;

        $userInfo = UserInfo::where('user_id', $id)->first();

        $userInfo->update([
            'bio' => $request->input('bio'),
        ]);

    }

    public function image(Request $request)
    {
        if ($request->hasFile('image')) {
            $userInfoService = new UserInfoService();
            $id = Auth::user()->id;
            $file = $request->file('image');
            $userInfo = $userInfoService->getById($id);
            $imageController = new ImageController();
            $imageId = $imageController->storeImage($file, '/profile');
            $oldId = $userInfo->image_id;

            $userInfo->update([
                'image_id' => $imageId,
            ]);

            if(!is_null($oldId)){
                $imageController->delete($oldId);
            }

        }
    }

}

