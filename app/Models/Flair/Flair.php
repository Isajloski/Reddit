<?php

namespace App\Models\Flair;

use App\Models\Community\Community;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flair extends Model
{
    use HasFactory;

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    protected $fillable = [
        'name',
        'community_id'
    ];


}
