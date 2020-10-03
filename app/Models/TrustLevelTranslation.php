<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustLevelTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'trust_level_id',
        'dejavu_l1_language_id',
        'name'
    ];
}
