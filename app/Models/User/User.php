<?php

namespace App\Models\User;

use App\Models\Community\Follow;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function karma()
    {
        return $this->hasOne(UserKarma::class);
    }

    public function status()
    {
        return $this->hasOne(UserStatus::class);
    }


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}

