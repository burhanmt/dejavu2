<?php

namespace App\Http\Requests;

use App\Models\DejavuL2Language;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDejavuL2LanguageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . DejavuL2Language::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
            'data.attributes.short_name' => 'sometimes|required|string|max:3',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
