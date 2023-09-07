<?php

namespace App\Models\User\dto;


class UserDto
{
    public int $id;
    public string $userName;

    public function __construct( $id,  $userName)
    {
        $this->id = $id;
        $this->userName = $userName;
    }
}
