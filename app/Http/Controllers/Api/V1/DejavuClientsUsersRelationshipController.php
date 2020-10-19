<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\DejavuClient;

class DejavuClientsUsersRelationshipController extends Controller
{
    public function index(DejavuClient $dejavuClient)
    {
        return JsonApiIdentifierResource::collection($dejavuClient->users);
    }
}
