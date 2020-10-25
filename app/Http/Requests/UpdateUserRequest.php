<?php

namespace App\Http\Requests;

use App\Models\User;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . User::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
            'data.attributes.family_name' => 'sometimes|required|string|max:50',
            'data.attributes.email' => 'sometimes|required|email|unique:users,email,' . $this->input('data.id') ,
            'data.attributes.password' => 'sometimes|required|string|max:255',
            'data.attributes.role' => 'sometimes|int|max:10',
            'data.attributes.timezone' => 'sometimes|string',
            'data.attributes.dejavu_client_id' => 'sometimes|required|int',
        ];
    }
}
