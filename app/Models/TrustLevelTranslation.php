<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrustLevelTranslation extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'trust_level_id',
        'dejavu_l1_language_id',
        'name'
    ];

    /**
     * "type" name convention method. It is based on route name.
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'trust-level-translations';
    }

    /**
     * It is mandatory field for JSON:API specification, therefore I use class name as type.
     * @return false|string
     */
    public function type()
    {
        return self::typeNameConvention();
    }
}
