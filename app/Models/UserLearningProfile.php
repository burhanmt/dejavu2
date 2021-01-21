<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserLearningProfile extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vocabulary_retention',
        'cefr_level'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'user-learning-profiles';
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
