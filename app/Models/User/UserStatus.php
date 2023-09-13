<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class UserStatus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','active', 'activity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateActiveStatus()
    {
        $currentTime = Carbon::now();
        $activityTime = Carbon::parse($this->activity);
        $timeDifferenceInMinutes = $activityTime->diffInMinutes($currentTime);
        $this->active = ($timeDifferenceInMinutes <= 5);
        $this->save();
    }

}
