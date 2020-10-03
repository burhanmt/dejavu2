<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExpressionTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_expression_id',
        'memory_level_id',
        'review_counter',
        'review_exam_counter',
        'speaking_practice_counter',
        'evaluation_datetime',
        'assessment_interval',
        'next_assessment_datetime',
        'email_sending_count'
    ];
}
