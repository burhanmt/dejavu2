<?php

namespace App\Http\Requests;

use App\Models\Interest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInterestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . Interest::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name'  => 'sometimes|required|string|max:100',
            'data.attributes.description' => 'sometimes|string|max:255',
        ];
    }
}
