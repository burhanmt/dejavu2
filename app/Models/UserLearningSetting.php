<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLearningSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dejavu_l1_language_id',
        'dejavu_l2_language_id',
        'goal_id',
        'interest_id'
    ];
}
