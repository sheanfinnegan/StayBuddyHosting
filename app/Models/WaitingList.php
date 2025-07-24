<?php

namespace App\Models;

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WaitingList extends Model
{
    //protected $table = 'waiting_lists';
    protected $primaryKey = 'wlid';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'homestay_id',
        'created',
        'remaining_time',
        'done',
    ];

    public function homestay()
    {
        return $this->belongsTo(HomeDetail::class, 'homestay_id', 'fsq_id');
    }

    public function users()
{
    return $this->hasMany(User::class, 'wlid', 'wlid');
}

// public function payment()
// {
//     return $this->hasOne(Payment::class, 'wlid', 'wlid');
// }
public function payment()
{
    return $this->hasMany(Payment::class, 'wlid', 'wlid');
}

// Payment spesifik user login
public function paymentForUser()
{
    return $this->hasOne(Payment::class, 'wlid', 'wlid')->where('user_id', Auth::id());
}
}
