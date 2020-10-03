<?php

namespace App\Models;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuClient extends Model
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
}
