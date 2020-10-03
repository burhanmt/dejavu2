<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDejavuL2LanguageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:DejavuL2Languages',
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50',
            'data.attributes.short_name' => 'required|string|max:3'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
