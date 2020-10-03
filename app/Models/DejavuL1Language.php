<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DejavuL1Language extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'interface_language_support'
    ];

    public function type()
    {
        return 'DejavuL1Languages';
    }
}
