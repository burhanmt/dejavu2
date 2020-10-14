<?php

namespace App\Http\Requests;

use App\Models\PartOfSpeech;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePartOfSpeechRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . PartOfSpeech::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
            'data.attributes.short_name' => 'sometimes|required|string|max:10',
        ];
    }
}