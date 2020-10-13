<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\TrustLevel;

class TrustLevelsTrustLevelTranslationsRelationshipsController extends Controller
{
    public function index(TrustLevel $trustLevel)
    {
        return JsonApiIdentifierResource::collection($trustLevel->trustLevelTranslations);
    }
}