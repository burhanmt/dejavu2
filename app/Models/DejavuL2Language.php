<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DejavuL2Language extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name'
    ];

    public function type()
    {
        return 'DejavuL2Languages';
    }
}
