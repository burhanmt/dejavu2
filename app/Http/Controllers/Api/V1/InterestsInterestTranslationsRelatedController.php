<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\Interest;

class InterestsInterestTranslationsRelatedController extends Controller
{
    public function index(Interest $interest)
    {
        return new JsonApiCollection($interest->interestTranslations);
    }
}
