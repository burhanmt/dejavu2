<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\Goal;

class GoalsGoalTranslationsRelatedController extends Controller
{
    public function index(Goal $goal)
    {
        return new JsonApiCollection($goal->goalTranslations);
    }
}
