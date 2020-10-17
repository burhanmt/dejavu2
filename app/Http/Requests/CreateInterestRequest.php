<?php

namespace App\Http\Requests;

use App\Models\Interest;
use Illuminate\Foundation\Http\FormRequest;

class CreateInterestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . Interest::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:100',
            'data.attributes.description' => 'string|max:255'
        ];
    }
}
