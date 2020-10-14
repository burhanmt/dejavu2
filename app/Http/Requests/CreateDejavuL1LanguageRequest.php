<?php

namespace App\Http\Requests;

use App\Models\DejavuL1Language;
use Illuminate\Foundation\Http\FormRequest;

class CreateDejavuL1LanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . DejavuL1Language::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50',
            'data.attributes.short_name' => 'required|string|max:3',
            'data.attributes.interface_language_support' => 'boolean'
        ];
    }
}
