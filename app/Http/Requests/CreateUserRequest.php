<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . User::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50',
            'data.attributes.family_name' => 'required|string|max:50',
            'data.attributes.email' => 'required|email|unique:users,email|max:255',
            'data.attributes.password' => 'required|string|max:255',
            'data.attributes.role' => 'int|max:10',
            'data.attributes.timezone' => 'string|max:255',
            'data.attributes.dejavu_client_id' => 'required|int',
        ];
    }
}
