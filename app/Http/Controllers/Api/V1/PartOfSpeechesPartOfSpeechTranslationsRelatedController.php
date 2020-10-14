<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\PartOfSpeech;

class PartOfSpeechesPartOfSpeechTranslationsRelatedController extends Controller
{
    public function index(PartOfSpeech $partOfSpeech)
    {
        return new JsonApiCollection($partOfSpeech->partOfSpeechTranslations);
    }
}