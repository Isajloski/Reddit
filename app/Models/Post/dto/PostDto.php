<?php

namespace App\Models\Post\dto;

use App\Models\Community\dto\CommunityDto;
use App\Models\Image\Image;
use App\Models\User\dto\UserDto;

class PostDto
{
    public int $id;
    public string $title;
    public string $body;
    public CommunityDto $community;
    public UserDto $user;
    public bool | null $vote;
    public int $karma;
    public int $comments_number;
    public string $date;

    public function __construct( $id, $title, $body, $date, $karma , $comments_number )
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->date = $date;
        $this->karma = $karma;
        $this->comments_number = $comments_number;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCommunityDto(CommunityDto $communityDto) : void{
        $this->community = $communityDto;
    }

    public function setBody(string $body) {
        $this->body = $body;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setImage(Image $image) {
        $this->image = $image;
    }

    public function setKarma(int $karma) {
        $this->karma = $karma;
    }

    public function setVote($vote) {
        $this->vote = $vote;
    }

    public function setCommentsNumber(int $comments_number) {
        $this->comments_number = $comments_number;
    }

    public function setUserDto(UserDto $userDto){
        $this->user = $userDto;
    }
}
