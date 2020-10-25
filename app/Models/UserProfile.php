<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'timezone_id',
        'birthday'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'user-profiles';
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
