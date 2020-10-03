<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscriptionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'renewable',
        'enabled',
        'package_price',
        'final_price',
        'utm_source',
        'utm_medium',
        'utm_campaign'
    ];
}
