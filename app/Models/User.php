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

    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'users';
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

    public function allowedAttributes()
    {
        return collect($this->attributes)
            ->filter(
                function ($item, $key) {
                    return !collect($this->hidden)->contains($key) && $key !== 'id';
                }
            )
            ->merge(
                [
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            );
    }

    /**
     * Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dejavuClients()
    {
        return $this->hasMany(DejavuClient::class, 'id', 'dejavu_client_id');
    }
}
