<?php

namespace App\Http\Requests;

use App\Models\UserLearningProfile;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserLearningProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . UserLearningProfile::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.user_id' => 'required|int',
            'data.attributes.vocabulary_retention' => 'int',
            'data.attributes.cefr_level' => 'string|max:2',
        ];
    }
}
