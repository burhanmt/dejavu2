<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDejavuL2LanguageRequest;
use App\Http\Requests\UpdateDejavuL2LanguageRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\DejavuL2Language;
use Spatie\QueryBuilder\QueryBuilder;

class DejavuL2LanguagesController extends Controller
{
    /**
     * DejavuL2LanguagesController constructor.
     */
    public function __construct()
    {
        /**
         * dejavu_l2_language is router parameter representative like:
         * api/v1/dejavu-l2-languages/{dejavu_l2_language}
         *
         */
        $this->authorizeResource(DejavuL2Language::class, 'dejavu_l2_language');
    }
    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $dejavuL2Languages = QueryBuilder::for(DejavuL2Language::class)
            ->allowedSorts(
                [
                    'name',
                    'short_name',
                    'created_at',
                    'updated_at'
                ]
            )->jsonPaginate();
        return new JsonApiCollection($dejavuL2Languages);
    }

    /**
     * @param CreateDejavuL2LanguageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDejavuL2LanguageRequest $request)
    {
        $dejavuL2Language = DejavuL2Language::create(
            [
                'name' => $request->input('data.attributes.name'),
                'short_name' => $request->input('data.attributes.short_name')
            ]
        );

        return (new JsonApiResource($dejavuL2Language))
            ->response()
            ->header('Location', route('dejavu-l2-languages.show', ['dejavu_l2_language' => $dejavuL2Language ]));
    }

    /**
     * @param DejavuL2Language $dejavuL2Language
     * @return JsonApiResource
     */
    public function show(DejavuL2Language $dejavuL2Language)
    {
        return new JsonApiResource($dejavuL2Language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DejavuL2Language  $dejavuL2Language
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDejavuL2LanguageRequest $request, DejavuL2Language $dejavuL2Language)
    {
        $dejavuL2Language->update($request->input('data.attributes'));
        return new JsonApiResource($dejavuL2Language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DejavuL2Language  $dejavuL2Language
     * @return \Illuminate\Http\Response
     */
    public function destroy(DejavuL2Language $dejavuL2Language)
    {
        $dejavuL2Language->delete();
        return response(null, 204);
    }
}
