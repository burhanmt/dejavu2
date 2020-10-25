<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApiCollection;
use App\Models\User;


class UsersDejavuClientsRelatedController extends Controller
{
    public function index(User $user)
    {
        return new JsonApiCollection($user->dejavuClients);
    }
}
