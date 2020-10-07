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
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'trust-levels';
    }

    /**
     * It is mandatory field for JSON:API specification, therefore I use class name as type.
     * @return false|string
     */
    public function type()
    {
        return self::typeNameConvention();
    }

    public function trustLevelTranslation()
    {
        return $this->hasMany(TrustLevelTranslation::class);
    }

    public function getTranslation($dejavu_l1_language_id)
    {
        return optional(TrustLevelTranslation::where('id', $this->id)
            ->where('dejavu_l1_language_id', $dejavu_l1_language_id)
            ->first())->name;
    }
}
