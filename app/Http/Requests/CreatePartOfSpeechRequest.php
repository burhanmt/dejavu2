<?php

namespace App\Http\Requests;

use App\Models\PartOfSpeech;
use Illuminate\Foundation\Http\FormRequest;

class CreatePartOfSpeechRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . PartOfSpeech::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50',
            'data.attributes.short_name' => 'required|string|max:10'
        ];
    }
}