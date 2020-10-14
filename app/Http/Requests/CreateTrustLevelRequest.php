<?php

namespace App\Http\Requests;

use App\Models\TrustLevel;
use Illuminate\Foundation\Http\FormRequest;

class CreateTrustLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . TrustLevel::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50'
        ];
    }
}
