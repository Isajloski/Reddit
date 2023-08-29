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
    public $fillable = ['user_id, post_id, vote'];
    protected $primaryKey = ['user_id', 'post_id'];
    public $incrementing = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
