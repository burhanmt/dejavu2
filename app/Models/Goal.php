<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
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
        return 'goals';
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
    public function goalTranslations()
    {
        return $this->hasMany(GoalTranslation::class);
    }
}
