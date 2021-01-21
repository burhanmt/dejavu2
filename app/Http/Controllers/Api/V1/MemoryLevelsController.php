<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\JsonApiResourceTraitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemoryLevelRequest;
use App\Http\Requests\UpdateMemoryLevelRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\MemoryLevel;
use Spatie\QueryBuilder\QueryBuilder;

class MemoryLevelsController extends Controller
{
    use JsonApiResourceTraitHelper;

    /**
     * MemoryLevelsController constructor.
     */
    public function __construct()
    {
        /**
         * memory_level is router parameter representative like:
         * api/v1/memory-levels/{memory_level}
         */
        $this->authorizeResource(MemoryLevel::class, 'memory_level');
    }

    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $memoryLevels = QueryBuilder::for(MemoryLevel::class)
            ->allowedSorts(
                [
                    'name',
                ]
            )
            ->allowedIncludes(['memoryLevelTranslations'])
            ->jsonPaginate();

        return new JsonApiCollection($memoryLevels);
    }

    /**
     * @param CreateMemoryLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMemoryLevelRequest $request)
    {
        return $this->createResource(
            MemoryLevel::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemoryLevel  $memoryLevel
     * @return \Illuminate\Http\Response
     */
    public function show(MemoryLevel $memoryLevel)
    {
        $query = QueryBuilder::for(MemoryLevel::where('id', $memoryLevel->id))
            ->allowedIncludes('memoryLevelTranslations')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateMemoryLevelRequest $request
     * @param MemoryLevel $memoryLevel
     * @return JsonApiResource
     */
    public function update(UpdateMemoryLevelRequest $request, MemoryLevel $memoryLevel)
    {
        $memoryLevel->update($request->input('data.attributes'));

        return new JsonApiResource($memoryLevel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemoryLevel  $memoryLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemoryLevel $memoryLevel)
    {
        $memoryLevel->delete();

        return response(null, 204);
    }
}
