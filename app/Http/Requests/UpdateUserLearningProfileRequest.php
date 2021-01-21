<?php

namespace App\Http\Requests;

use App\Models\UserLearningProfile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLearningProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . UserLearningProfile::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.user_id' => 'sometimes|required|int',
            'data.attributes.vocabulary_retention' => 'sometimes|int',
            'data.attributes.cefr_level' => 'sometimes|string|max:2',
        ];
    }
}
