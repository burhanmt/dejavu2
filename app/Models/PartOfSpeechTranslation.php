<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartOfSpeechTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_of_speech_id',
        'dejavu_l1_language_id',
        'name',
        'short_name'
    ];
}
