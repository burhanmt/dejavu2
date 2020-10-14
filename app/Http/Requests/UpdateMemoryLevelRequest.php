<?php

namespace App\Http\Requests;

use App\Models\MemoryLevel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemoryLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . MemoryLevel::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
            'data.attributes.description' => 'sometimes|string|max:255',
        ];
    }
}