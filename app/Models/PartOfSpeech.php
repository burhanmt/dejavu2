<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartOfSpeech extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
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
        return 'part-of-speeches';
    }

    /**
     * It is mandatory field for JSON:API specification, therefore I use route name as type.
     *
     * @return false|string
     */
    public function type()
    {
        return self::typeNameConvention();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partOfSpeechTranslations()
    {
        return $this->hasMany(PartOfSpeechTranslation::class);
    }
}
