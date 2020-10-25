<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UsersController extends Controller
{

    public function __construct()
    {
        /**
         * user is router parameter representative like:
         * api/v1/users/{user}
         */
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedSorts(
                [
                    'name',
                    'family_name',
                    'email',
                    'password',
                    'role',
                    'timezone',
                    'dejavu_client_id',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['dejavuClients'])
            ->jsonPaginate();

        return new JsonApiCollection($users);
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create(
            [
                'name' => $request->input('data.attributes.name'),
                'family_name' => $request->input('data.attributes.family_name'),
                'email' => $request->input('data.attributes.email'),
                'password' => $request->input('data.attributes.password'),
                'role' => $request->input('data.attributes.role'),
                'timezone' => $request->input('data.attributes.timezone'),
                'dejavu_client_id' => $request->input('data.attributes.dejavu_client_id'),
            ]
        );

        return (new JsonApiResource($user))
            ->response()
            ->header('Location', route('users.show', ['user' => $user]));
    }

    /**
     * @param User $user
     * @return JsonApiResource
     */
    public function show(User $user)
    {
        $query = QueryBuilder::for(User::where('id', $user->id))
            ->allowedIncludes('dejavuClients')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonApiResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->input('data.attributes'));

        return new JsonApiResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, 204);
    }
}
