<?php

namespace App\Models;

use App\Helpers\UserRoleTraitHelper;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /**
     * HasUUID is a package which is the link: https://github.com/binarycabin/laravel-uuid
     * This package adds a very simple trait to automatically generate a UUID for the Model if
     * "uuid" field exists in the table.
     */
    use HasUUID;

    use UserRoleTraitHelper;

    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'family_name',
        'email',
        'password',
        'role',
        'dejavu_client_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
