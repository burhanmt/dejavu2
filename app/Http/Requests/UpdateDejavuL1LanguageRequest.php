<?php

namespace App\Http\Requests;

use App\Models\DejavuL1Language;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDejavuL1LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . DejavuL1Language::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
            'data.attributes.short_name' => 'sometimes|required|string|max:3',
            'data.attributes.interface_language_support' => 'sometimes|boolean'
        ];
    }
}
