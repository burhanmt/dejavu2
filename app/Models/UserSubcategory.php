<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_category_id',
        'name'
    ];
}
