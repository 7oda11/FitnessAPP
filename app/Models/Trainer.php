<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    protected $fillable = [
        'name', 'email', 'username', 'password', 'gender', 'age', 'location', 'phone', 'weight', 'height',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'trainer_user', 'trainer_id', 'user_id');
    }
}
