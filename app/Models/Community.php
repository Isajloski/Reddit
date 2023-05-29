<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Community extends Model
{
    use HasFactory;

    /**
     * @var int|mixed|string|null
     */
    protected $fillable = ['user_id', 'name', 'description', 'rules', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
