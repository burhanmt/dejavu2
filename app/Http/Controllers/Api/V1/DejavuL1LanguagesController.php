<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDejavuL1LanguageRequest;
use App\Http\Requests\UpdateDejavuL1LanguageRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\DejavuL1Language;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class DejavuL1LanguagesController extends Controller
{
    /**
     * DejavuL1LanguagesController constructor.
     */
    public function __construct()
    {
        /**
         * dejavu_l1_language is router parameter representative like:
         * api/v1/dejavu-l1-languages/{dejavu_l1_language}
         *
         */
        $this->authorizeResource(DejavuL1Language::class, 'dejavu_l1_language');
    }
    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $dejavuL1Languages = QueryBuilder::for(DejavuL1Language::class)
            ->allowedSorts(
                [
                    'name',
                    'short_name',
                    'interface_language_support',
                    'created_at',
                    'updated_at'
                ]
            )->jsonPaginate();
        return new JsonApiCollection($dejavuL1Languages);
    }

    /**
     * @param CreateDejavuL1LanguageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDejavuL1LanguageRequest $request)
    {
        $dejavuL1Language = DejavuL1Language::create(
            [
                'name' => $request->input('data.attributes.name'),
                'short_name' => $request->input('data.attributes.short_name'),
                'interface_language_support' => $request->input('data.attributes.interface_language_support')
            ]
        );

        return (new JsonApiResource($dejavuL1Language))
            ->response()
            ->header('Location', route('dejavu-l1-languages.show', ['dejavu_l1_language' => $dejavuL1Language ]));
    }

    /**
     * @param DejavuL1Language $dejavuL1Language
     * @return JsonApiResource
     */
    public function show(DejavuL1Language $dejavuL1Language)
    {
        return new JsonApiResource($dejavuL1Language);
    }

    /**
     * @param UpdateDejavuL1LanguageRequest $request
     * @param DejavuL1Language $dejavuL1Language
     * @return JsonApiResource
     */
    public function update(UpdateDejavuL1LanguageRequest $request, DejavuL1Language $dejavuL1Language)
    {
        $dejavuL1Language->update($request->input('data.attributes'));
        return new JsonApiResource($dejavuL1Language);
    }

    /**
     * @param DejavuL1Language $dejavuL1Language
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DejavuL1Language $dejavuL1Language)
    {
        $dejavuL1Language->delete();
        return response(null, 204);
    }
}
