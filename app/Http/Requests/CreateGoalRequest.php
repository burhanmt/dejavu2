<?php

namespace App\Http\Requests;

use App\Models\Goal;
use Illuminate\Foundation\Http\FormRequest;

class CreateGoalRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . Goal::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:100',
            'data.attributes.description' => 'string|max:255'
        ];
    }
}
