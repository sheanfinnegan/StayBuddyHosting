<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';
    protected $fillable = ['wlid', 'price', 'deadline', 'paid', 'user_id'];

    public function waitingList()
    {
        return $this->belongsTo(WaitingList::class, 'wlid', 'wlid');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
