<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class TrustLevel extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'trust-levels';
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
     * A trust level record can have many translations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustLevelTranslations()
    {
        return $this->hasMany(TrustLevelTranslation::class);
    }

    /**
     * This method gives the translation of the existing request by giving translation_id.
     * "translation_id" is "dejavu_l1_language_id"  For instance, 1 is English, 2 is Turkish.
     *
     * @param $dejavu_l1_language_id
     * @return mixed|string|null
     */
    public function getTranslation($dejavu_l1_language_id)
    {
        return optional(TrustLevelTranslation::where('id', $this->id)
            ->where('dejavu_l1_language_id', $dejavu_l1_language_id)
            ->first())->name;
    }
}
