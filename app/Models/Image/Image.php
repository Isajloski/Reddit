<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function getPathAttribute()
    {
        return '/storage/' . $this->attributes['path'];
    }

}
