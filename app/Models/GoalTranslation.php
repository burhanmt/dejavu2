<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'dejavu_l1_language_id',
        'name',
        'description'
    ];
}
