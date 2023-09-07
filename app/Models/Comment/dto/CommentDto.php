<?php

namespace App\Models\Comment\dto;

use App\Models\User\dto\UserDto;

class CommentDto
{
    public int $id;
    public int | null $parent_comment_id;
    public UserDto $user;
    public int | null $post_id;
    public string $body;
    public int $karma;
    public string $date;
    public int | null $replies;
    public bool | null $vote;


    public function __construct( ){}

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setParentCommentId(int | null $parentCommentId): void
    {
        $this->parent_comment_id = $parentCommentId;
    }

    public function getParentCommentId(): int
    {
        return $this->parent_comment_id;
    }

    public function setUserDto(UserDto $userDto): void
    {
        $this->user = $userDto;
    }

    public function getUserDto(): UserDto
    {
        return $this->user;
    }

    public function setPostId(int | null $postId): void
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

    public function setVote(bool | null $vote): void
    {
        $this->vote = $vote;
    }

    public function getVote(): string
    {
        return $this->vote;
    }

    public function setKarma(int $karma): void
    {
        $this->karma = $karma;
    }

    public function getKarma(): int
    {
        return $this->karma;
    }

    public function setRepliesNumber(int | null $replies): void
    {
        $this->replies = $replies;
    }

    public function getRepliesNumber(): int
    {
        return $this->replies;
    }


}
