<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuVocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_of_speech_id',
        'dejavu_l2_language_id',
        'dejavu_category_id',
        'dejavu_subcategory_id',
        'vocabulary',
        'cefr_level',
        'american_ipa',
        'corpus_frequency_level',
        'trust_level_id'
    ];
}
