<?php

namespace App\Http\Requests;

use App\Models\DejavuClient;
use Illuminate\Foundation\Http\FormRequest;

class CreateDejavuClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . DejavuClient::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.client_name' => 'required|string|max:100',
            'data.attributes.client_domain_name' => 'string|max:50',
            'data.attributes.enabled' => 'boolean'
        ];
    }
}
