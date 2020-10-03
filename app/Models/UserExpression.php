<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExpression extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dejavu_expression_id',
        'dejavu_l2_language_id',
        'user_category_id',
        'user_subcategory_id',
        'expression',
    ];
}
