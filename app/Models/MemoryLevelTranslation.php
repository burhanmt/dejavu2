<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryLevelTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'memory_level_id',
        'dejavu_l1_language_id',
        'name',
        'description'
    ];
}
