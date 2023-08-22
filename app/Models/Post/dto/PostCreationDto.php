<?php

namespace App\Models\Post\dto;

use App\Models\dto\CommunityDto;
use App\Models\dto\UserDto;
use Illuminate\Database\Eloquent\Collection;

class PostCreationDto
{
    public int $id;
    public string $title;
    public string $body;

    public function __construct( $id, $title, $body )
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }
}
