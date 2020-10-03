<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTrustLevelRequest;
use App\Http\Requests\UpdateTrustLevelRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\TrustLevel;
use Spatie\QueryBuilder\QueryBuilder;

class TrustLevelsController extends Controller
{

    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $trust_levels = QueryBuilder::for(TrustLevel::class)
            ->allowedSorts(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ]
            )->jsonPaginate();
        return new JsonApiCollection($trust_levels);
    }

    /**
     * @param CreateTrustLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTrustLevelRequest $request)
    {
        $trust_levels = TrustLevel::create(
            [
                'name' => $request->input('data.attributes.name'),
            ]
        );

        return (new JsonApiResource($trust_levels))
            ->response()
            ->header('Location', route('trust-levels.show', ['trust_levels' => $trust_levels ]));
    }

    /**
     * @param TrustLevel $trust_level
     * @return JsonApiResource
     */
    public function show(TrustLevel $trust_level)
    {
        return new JsonApiResource($trust_level);
    }

    /**
     * @param UpdateTrustLevelRequest $request
     * @param TrustLevel $trust_level
     * @return JsonApiResource
     */
    public function update(UpdateTrustLevelRequest $request, TrustLevel $trust_level)
    {
        $trust_level->update($request->input('data.attributes'));
        return new JsonApiResource($trust_level);
    }

    /**
     * @param TrustLevel $trust_level
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TrustLevel $trust_level)
    {
        $trust_level->delete();
        return response(null, 204);
    }
}
