<?php

namespace App\Models;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DejavuClient extends AbstractApiModel
{
    /**
     * HasUUID is a package which is the link: https://github.com/binarycabin/laravel-uuid
     * This package adds a very simple trait to automatically generate a UUID for the Model if
     * "uuid" field exists in the table.
     */
    use HasUUID;

    use HasFactory;

    protected $fillable = [
        'uuid',
        'client_name',
        'client_domain_name',
        'enabled'
    ];

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'dejavu-clients';
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
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
