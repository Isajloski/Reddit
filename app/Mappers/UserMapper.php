<?php

namespace App\Mappers;

use App\Models\dto\UserDto;
use App\Models\User;

class UserMapper
{

    public function mapToDto(User $user)
    {
        return new UserDto($user->id, $user->name);
    }

}
