<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuExpression extends Model
{
    use HasFactory;

    protected $fillable = [
        'dejavu_l2_language_id',
        'dejavu_category_id',
        'dejavu_subcategory_id',
        'expression',
        'trust_level_id'
    ];
}
