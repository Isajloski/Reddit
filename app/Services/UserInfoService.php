<?php

namespace App\Services;

use App\Models\User\UserInfo;

class UserInfoService{

    public function getById($id){
        return UserInfo::where('user_id', $id)->first();
    }

}
