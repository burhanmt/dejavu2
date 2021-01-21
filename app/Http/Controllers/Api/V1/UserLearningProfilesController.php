<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\JsonApiResourceTraitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserLearningProfileRequest;
use App\Http\Requests\UpdateUserLearningProfileRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\UserLearningProfile;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserLearningProfilesController extends Controller
{
    use JsonApiResourceTraitHelper;

    /**
     * UserLearningProfilesController constructor.
     */
    public function __construct()
    {
        /**
         * user_learning_profile is router parameter representative like:
         * api/v1/user-learning-profiles/{user_learning_profile}
         */
        $this->authorizeResource(UserLearningProfile::class, 'user_learning_profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLearningProfiles = QueryBuilder::for(TrustLevel::class)
            ->allowedSorts(
                [
                    'vocabulary_retention',
                    'cefr_level',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['user'])
            ->jsonPaginate();

        return new JsonApiCollection($userLearningProfiles);
    }


    /**
     * @param CreateUserLearningProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserLearningProfileRequest $request)
    {
        return $this->createResource(
            UserLearningProfile::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLearningProfile  $userLearningProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserLearningProfile $userLearningProfile)
    {
        $query = QueryBuilder::for(UserLearningProfile::where('id', $userLearningProfile->id))
            ->allowedIncludes('user')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateUserLearningProfileRequest $request
     * @param UserLearningProfile $userLearningProfile
     * @return JsonApiResource
     */
    public function update(UpdateUserLearningProfileRequest $request, UserLearningProfile $userLearningProfile)
    {
        $userLearningProfile->update($request->input('data.attributes'));

        return new JsonApiResource($userLearningProfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLearningProfile  $userLearningProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLearningProfile $userLearningProfile)
    {
        $userLearningProfile->delete();

        return response(null, 204);
    }
}
