<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiIdentifierResource;
use App\Models\User;

class UsersDejavuClientsRelationshipsController extends Controller
{
    public function index(User $user)
    {
        return JsonApiIdentifierResource::collection($user->dejavuClients);
    }
}
