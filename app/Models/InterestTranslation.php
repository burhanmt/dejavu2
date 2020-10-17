<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class InterestTranslation extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'interest_id',
        'dejavu_l1_language_id',
        'name',
        'description'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'interest-translations';
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
}
