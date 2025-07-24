<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'UID';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }
}
