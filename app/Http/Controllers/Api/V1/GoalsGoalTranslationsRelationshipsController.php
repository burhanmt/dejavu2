<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\Goal;

class GoalsGoalTranslationsRelationshipsController extends Controller
{
    public function index(Goal $goal)
    {
        return JsonApiIdentifierResource::collection($goal->goalTranslations);
    }
}
