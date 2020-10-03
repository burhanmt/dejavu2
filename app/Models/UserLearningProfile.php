<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLearningProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vocabulary_retention',
        'cefr_level'
    ];
}
