<?php

namespace App\Mappers;

use App\Models\User\dto\UserDto;
use App\Models\User\User;

class UserMapper
{

    public function mapToDto(User $user)
    {
        return new UserDto($user->id, $user->name);
    }

}
