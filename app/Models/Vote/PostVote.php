<?php

namespace App\Models\Vote;

use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    use HasFactory;
    /**
     * @var int|mixed|string|null
     */
    protected $fillable = ['user_id, post_id, vote'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
