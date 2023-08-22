<?php

namespace App\Models\Comment\dto;

use App\Models\dto\UserDto;

class CommentDto
{
    public int $id;
    public int $parent_comment_id;
    public UserDto $userDto;
    public int $post_id;
    public string $body;
    public int $karma;
    public int $replies;


    public function __construct( ){}

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setParentCommentId(int $parentCommentId): void
    {
        $this->parent_comment_id = $parentCommentId;
    }

    public function getParentCommentId(): int
    {
        return $this->parent_comment_id;
    }

    public function setUserDto(UserDto $userDto): void
    {
        $this->userDto = $userDto;
    }

    public function getUserDto(): UserDto
    {
        return $this->userDto;
    }

    public function setPostId(int $postId): void
    {
        $this->post_id = $postId;
    }

    public function getPostId(): int
    {
        return $this->post_id;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setKarma(int $karma): void
    {
        $this->karma = $karma;
    }

    public function getKarma(): int
    {
        return $this->karma;
    }

    public function setRepliesNumber(int $replies): void
    {
        $this->replies = $replies;
    }

    public function getRepliesNumber(): int
    {
        return $this->replies;
    }


}
