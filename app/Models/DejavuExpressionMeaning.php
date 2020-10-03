<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuExpressionMeaning extends Model
{
    use HasFactory;

    protected $fillable = [
        'dejavu_expression_id',
        'dejavu_l1_language_id',
        'meaning'
    ];
}
