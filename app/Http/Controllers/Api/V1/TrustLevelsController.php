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
            )->allowedIncludes(['trustLevelTranslation'])
             ->jsonPaginate();

        return new JsonApiCollection($trust_levels);
    }

    /**
     * @param CreateTrustLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTrustLevelRequest $request)
    {
        $trust_level = TrustLevel::create(
            [
                'name' => $request->input('data.attributes.name'),
            ]
        );

        return (new JsonApiResource($trust_level))
            ->response()
            ->header('Location', route('trust-levels.show', ['trust_level' => $trust_level ]));
    }

    /**
     * This method supports translation of the trust_level if you use ?translate=<dejavu_l1_language_id>
     *
     * @param TrustLevel $trust_level
     * @param Request $request
     * @return JsonApiResource
     */
    public function show(TrustLevel $trust_level, Request $request)
    {
        $query = QueryBuilder::for(TrustLevel::where('id', $trust_level->id))
            ->allowedIncludes('trustLevelTranslation')
            ->firstOrFail();

        $translation_array = [];
        if ($request->has('translate')) {
            $get_translation = $trust_level->getTranslation($request->input('translate'));
            if (!empty($get_translation)) {
                $translation_array = ['meta' => [
                'translation' => $get_translation,
                'dejavu_l1_language_id' => $request->input('translate')
                ]];
            }
        }
        
        return (new JsonApiResource($query))
            ->additional($translation_array);
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
