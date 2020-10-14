<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\MemoryLevel;

class MemoryLevelsMemoryLevelTranslationsRelationshipsController extends Controller
{
    public function index(MemoryLevel $memoryLevel)
    {
        return JsonApiIdentifierResource::collection($memoryLevel->memoryLevelTranslations);
    }
}