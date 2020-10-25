<?php

namespace App\Http\Requests;

use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . UserProfile::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.user_id' => 'sometimes|required|int',
            'data.attributes.country_id' => 'sometimes|int',
            'data.attributes.timezone_id' => 'sometimes|int',
            'data.attributes.birthday' => 'sometimes|date',
        ];
    }
}
