<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_of_speech_id',
        'dejavu_vocabulary_id',
        'dejavu_l2_language_id',
        'user_category_id',
        'user_subcategory_id',
        'vocabulary',
        'cefr_level',
        'british_ipa',
        'american_ipa',
        'corpus_frequency_level'
    ];
}
