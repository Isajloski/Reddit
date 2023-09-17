<?php

namespace App\Models\Post\dto;


class PostCreationDto
{
    public int $id;
    public string $title;
    public string $body;

    public function __construct($id = null, $title = null, $body = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }
}
