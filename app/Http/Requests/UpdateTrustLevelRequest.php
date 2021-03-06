<?php

namespace App\Http\Requests;

use App\Models\TrustLevel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrustLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . TrustLevel::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
        ];
    }
}
