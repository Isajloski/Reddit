<?php

namespace App\Models\Comment;

use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * @var int|mixed|string|null
     */
    protected $fillable = ['user_id', 'post_id', 'parent_comment_id', 'body'];


    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

}
