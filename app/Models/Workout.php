<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'trainer_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trainer that owns the exercise.
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
