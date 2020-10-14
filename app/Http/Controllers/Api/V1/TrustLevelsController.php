<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTrustLevelRequest;
use App\Http\Requests\UpdateTrustLevelRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\TrustLevel;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TrustLevelsController extends Controller
{
    /**
     * TrustLevelsController constructor.
     */
    public function __construct()
    {
        /**
         * trust_level is router parameter representative like:
         * api/v1/trust-levels/{trust_level}
         */
        $this->authorizeResource(TrustLevel::class, 'trust_level');
    }
    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $trustLevels = QueryBuilder::for(TrustLevel::class)
            ->allowedSorts(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['trustLevelTranslations'])
             ->jsonPaginate();

        return new JsonApiCollection($trustLevels);
    }

    /**
     * @param CreateTrustLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTrustLevelRequest $request)
    {
        $trustLevel = TrustLevel::create(
            [
                'name' => $request->input('data.attributes.name'),
            ]
        );

        return (new JsonApiResource($trustLevel))
            ->response()
            ->header('Location', route('trust-levels.show', ['trust_level' => $trustLevel ]));
    }

    /**
     * This method supports translation of the trust_level if you use ?translate=<dejavu_l1_language_id>
     *
     * @param TrustLevel $trustLevel
     * @param Request $request
     * @return JsonApiResource
     */
    public function show(TrustLevel $trustLevel, Request $request)
    {
        $query = QueryBuilder::for(TrustLevel::where('id', $trustLevel->id))
            ->allowedIncludes('trustLevelTranslations')
            ->firstOrFail();

        $translationArray = [];
        if ($request->has('translate')) {
            $get_translation = $trustLevel->getTranslation($request->input('translate'));
            if (!empty($get_translation)) {
                $translationArray = ['meta' => [
                'translation' => $get_translation,
                'dejavu_l1_language_id' => $request->input('translate')
                ]];
            }
        }
        
        return (new JsonApiResource($query))
            ->additional($translationArray);
    }

    /**
     * @param UpdateTrustLevelRequest $request
     * @param TrustLevel $trustLevel
     * @return JsonApiResource
     */
    public function update(UpdateTrustLevelRequest $request, TrustLevel $trustLevel)
    {
        $trustLevel->update($request->input('data.attributes'));

        return new JsonApiResource($trustLevel);
    }

    /**
     * @param TrustLevel $trustLevel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TrustLevel $trustLevel)
    {
        $trustLevel->delete();

        return response(null, 204);
    }
}
