<?php

namespace App\Http\Requests;

use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . UserProfile::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.user_id' => 'required|int',
            'data.attributes.country_id' => 'int',
            'data.attributes.timezone_id' => 'int',
            'data.attributes.birthday' => 'date',
        ];
    }
}
