<?php

namespace App\Http\Requests;

use App\Models\DejavuClient;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDejavuClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . DejavuClient::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.client_name' => 'sometimes|required|string|max:100',
            'data.attributes.client_domain_name' => 'sometimes|string|max:50',
            'data.attributes.enabled' => 'sometimes|boolean'
        ];
    }
}
