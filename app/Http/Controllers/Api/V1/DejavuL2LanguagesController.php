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
     * @return JsonApiCollection
     */
    public function index()
    {
        $dejavu_l2_languages = QueryBuilder::for(DejavuL2Language::class)
            ->allowedSorts(
                [
                    'name',
                    'short_name',
                    'created_at',
                    'updated_at'
                ]
            )->jsonPaginate();
        return new JsonApiCollection($dejavu_l2_languages);
    }

    /**
     * @param CreateDejavuL2LanguageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDejavuL2LanguageRequest $request)
    {
        $dejavu_l2_language = DejavuL2Language::create(
            [
                'name' => $request->input('data.attributes.name'),
                'short_name' => $request->input('data.attributes.short_name')
            ]
        );

        return (new JsonApiResource($dejavu_l2_language))
            ->response()
            ->header('Location', route('dejavu-l2-languages.show', ['dejavu_l2_language' => $dejavu_l2_language ]));
    }

    /**
     * @param DejavuL2Language $dejavu_l2_language
     * @return JsonApiResource
     */
    public function show(DejavuL2Language $dejavu_l2_language)
    {
        return new JsonApiResource($dejavu_l2_language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DejavuL2Language  $dejavu_l2_language
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDejavuL2LanguageRequest $request, DejavuL2Language $dejavu_l2_language)
    {
        $dejavu_l2_language->update($request->input('data.attributes'));
        return new JsonApiResource($dejavu_l2_language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DejavuL2Language  $dejavu_l2_language
     * @return \Illuminate\Http\Response
     */
    public function destroy(DejavuL2Language $dejavu_l2_language)
    {
        $dejavu_l2_language->delete();
        return response(null, 204);
    }
}
