<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'interest_id',
        'dejavu_l1_language_id',
        'name',
        'description'
    ];
}
