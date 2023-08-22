<?php

namespace App\Models\Comment\dto;

class CommentCreationRequest
{
    public string $body;
    public int $post_id;
    public int $parent_comment_id;

}
