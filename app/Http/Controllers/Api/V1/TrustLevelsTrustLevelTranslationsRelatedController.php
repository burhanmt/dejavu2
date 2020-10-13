<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\TrustLevel;

class TrustLevelsTrustLevelTranslationsRelatedController extends Controller
{
    public function index(TrustLevel $trustLevel)
    {
        dump($trustLevel->trustLevelTranslations);
        return new JsonApiCollection($trustLevel->trustLevelTranslations);
    }
}