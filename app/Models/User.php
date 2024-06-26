<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use   Notifiable;



    protected $fillable = [
        'name', 'email', 'username', 'password', 'gender', 'age', 'location', 'phone', 'weight', 'height',
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
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_user', 'user_id', 'trainer_id');
    }
}
