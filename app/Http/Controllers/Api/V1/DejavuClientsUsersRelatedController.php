<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\DejavuClient;

class DejavuClientsUsersRelatedController extends Controller
{
    public function index(DejavuClient $dejavuClient)
    {
        return new JsonApiCollection($dejavuClient->users);
    }
}
