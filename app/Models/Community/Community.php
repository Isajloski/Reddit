<?php

namespace App\Models\Community;

use App\Models\Flair\Flair;
use App\Models\Image\Image;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Community extends Model
{
    use HasFactory;

    /**
     * @var int|mixed|string|null
     */
    protected $fillable = ['user_id', 'name', 'description', 'rules', 'image_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
