<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use HasFactory;

    /**
     * @var int|mixed|string|null
     */
    protected $fillable =
        ['community_id, user_id, title, body, flair_id, image_id, karma'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function flairs()
    {
        return $this->hasMany(Flair::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
