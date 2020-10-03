<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVocabularyMnemonic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_vocabulary_id',
        'sentence'
    ];
}
