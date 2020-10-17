<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\Interest;

class InterestsInterestTranslationsRelationshipsController extends Controller
{
    public function index(Interest $interest)
    {
        return JsonApiIdentifierResource::collection($interest->interestTranslations);
    }
}
