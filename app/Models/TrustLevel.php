<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class TrustLevel extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function type()
    {
        return 'TrustLevels';
    }
}
