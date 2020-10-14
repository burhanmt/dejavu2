<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class MemoryLevelTranslation extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'memory_level_id',
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
        return 'memory-level-translations';
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
