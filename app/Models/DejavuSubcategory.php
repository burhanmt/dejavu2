<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'dejavu_category_id',
        'name'
    ];
}
