<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\JsonApiResourceTraitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\Goal;
use Spatie\QueryBuilder\QueryBuilder;

class GoalsController extends Controller
{
    use JsonApiResourceTraitHelper;

    public function __construct()
    {
        /**
         * goal is router parameter representative like:
         * api/v1/goal/{goal}
         */
        $this->authorizeResource(Goal::class, 'goal');
    }

    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $goals = QueryBuilder::for(Goal::class)
            ->allowedSorts(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ]
            )
            ->allowedIncludes(['goalTranslations'])
            ->jsonPaginate();

        return new JsonApiCollection($goals);
    }

    /**
     * @param CreateGoalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateGoalRequest $request)
    {
        return $this->createResource(
            Goal::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * @param Goal $goal
     * @return JsonApiResource
     */
    public function show(Goal $goal)
    {
        $query = QueryBuilder::for(Goal::where('id', $goal->id))
            ->allowedIncludes('goalTranslations')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateGoalRequest $request
     * @param Goal $goal
     * @return JsonApiResource
     */
    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $goal->update($request->input('data.attributes'));

        return new JsonApiResource($goal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return response(null, 204);
    }
}
