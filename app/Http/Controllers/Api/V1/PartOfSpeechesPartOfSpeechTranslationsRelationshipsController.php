<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\PartOfSpeech;

class PartOfSpeechesPartOfSpeechTranslationsRelationshipsController extends Controller
{
    public function index(PartOfSpeech $partOfSpeech)
    {
        return JsonApiIdentifierResource::collection($partOfSpeech->partOfSpeechTranslations);
    }
}