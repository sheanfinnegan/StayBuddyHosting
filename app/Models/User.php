<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    // protected $primaryKey = 'UID';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'desc',
        'email',
        'phone_num',
        'bod',
        'gender',
        'occupation',
        'password',
        'profile_picture', // Tambahkan field profile_picture
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'UID');
    }

    public function preference()
    {
        return $this->hasOne(UserPreference::class, 'user_id');
    }
    public function waitingList()
{
    return $this->belongsTo(WaitingList::class, 'wlid', 'wlid');
}

public function payments()
{
    return $this->hasMany(Payment::class, 'user_id');
}

}
