<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userProfiles = QueryBuilder::for(UserProfile::class)
            ->allowedSorts(
                [
                    'user_id',
                    'country_id',
                    'timezone_id',
                    'birthday',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['user'])
            ->jsonPaginate();

        return new JsonApiCollection($userProfiles);
    }

    /**
     * @param CreateUserProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserProfileRequest $request)
    {
        $userProfile = UserProfile::create(
            [
                'user_id' => $request->input('data.attributes.user_id'),
                'country_id' => $request->input('data.attributes.country_id'),
                'timezone_id' => $request->input('data.attributes.timezone_id'),
                'birthday' => $request->input('data.attributes.birthday'),
            ]
        );

        return (new JsonApiResource($userProfile))
            ->response()
            ->header('Location', route('user-profiles.show', ['user_profile' => $userProfile]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        $query = QueryBuilder::for(UserProfile::where('id', $userProfile->id))
            ->allowedIncludes('user')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        $userProfile->update($request->input('data.attributes'));

        return new JsonApiResource($userProfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();

        return response(null, 204);
    }
}
