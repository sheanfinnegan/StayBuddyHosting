<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    //
    protected $table = 'user_preferences';

    protected $fillable = [
        'user_id',
        'smoking',
        'sleep_schedule',
        'room_temperature',
        'alcoholic',
        'air_conditioner',
        'silent',
        'tidiness',
        'socializing',
        'noise_tolerance',
        'prefered_age',
        'cooking_frequency',
        'music_genre',
    ];
}
