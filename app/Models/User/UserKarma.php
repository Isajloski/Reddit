<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKarma extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'karma'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
