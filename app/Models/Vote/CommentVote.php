<?php

namespace App\Models\Vote;

use App\Models\Comment\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{

    use HasFactory;
    /**
     * @var int|mixed|string|null
     */

    public $fillable = ['user_id, comment_id, vote'];
    protected $primaryKey = ['user_id', 'comment_id'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

}
