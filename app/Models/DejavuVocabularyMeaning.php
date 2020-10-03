<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuVocabularyMeaning extends Model
{
    use HasFactory;

    protected $fillable = [
        'dejavu_vocabulary_id',
        'meaning'
    ];
}
