<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\MemoryLevel;


class MemoryLevelsMemoryLevelTranslationsRelatedController extends Controller
{
    public function index(MemoryLevel $memoryLevel)
    {
        return new JsonApiCollection($memoryLevel->memoryLevelTranslations);
    }
}