<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartOfSpeechTranslation extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'part_of_speech_id',
        'dejavu_l1_language_id',
        'name',
        'short_name'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'part-of-speech-translations';
    }

    /**
     * It is mandatory field for JSON:API specification, therefore I use class name as type.
     *
     * @return false|string
     */
    public function type()
    {
        return self::typeNameConvention();
    }
}
