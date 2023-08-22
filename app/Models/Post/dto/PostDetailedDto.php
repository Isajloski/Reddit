<?php

namespace App\Models\Post\dto;

use App\Models\dto\CommunityDto;
use App\Models\dto\UserDto;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

class PostDetailedDto
{
    public int $id;
    public string $title;
    public string $body;
    public CommunityDto $community;
    public UserDto $user;
    public int $karma;
    public int $comments_number;
    public Collection $comments;
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

    public function setCommentsNumber(int $comments_number) {
        $this->comments_number = $comments_number;
    }

    public function setComments(Collection $comments) {
        $this->comments = $comments;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setUserDto(UserDto $userDto){
        $this->user = $userDto;
    }
}
