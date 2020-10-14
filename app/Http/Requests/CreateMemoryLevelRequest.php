<?php

namespace App\Http\Requests;

use App\Models\MemoryLevel;
use Illuminate\Foundation\Http\FormRequest;

class CreateMemoryLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . MemoryLevel::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50',
            'data.attributes.description' => 'string|max:255'
        ];
    }
}