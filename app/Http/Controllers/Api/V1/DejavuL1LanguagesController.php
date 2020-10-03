<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDejavuL1LanguageRequest;
use App\Http\Requests\UpdateDejavuL1LanguageRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\DejavuL1Language;
use Spatie\QueryBuilder\QueryBuilder;

class DejavuL1LanguagesController extends Controller
{
    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $dejavu_l1_languages = QueryBuilder::for(DejavuL1Language::class)
            ->allowedSorts(
                [
                    'name',
                    'short_name',
                    'interface_language_support',
                    'created_at',
                    'updated_at'
                ]
            )->jsonPaginate();
        return new JsonApiCollection($dejavu_l1_languages);
    }

    /**
     * @param CreateDejavuL1LanguageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDejavuL1LanguageRequest $request)
    {
        $dejavu_l1_language = DejavuL1Language::create(
            [
                'name' => $request->input('data.attributes.name'),
                'short_name' => $request->input('data.attributes.short_name'),
                'interface_language_support' => $request->input('data.attributes.interface_language_support')
            ]
        );

        return (new JsonApiResource($dejavu_l1_language))
            ->response()
            ->header('Location', route('dejavu-l1-languages.show', ['dejavu_l1_language' => $dejavu_l1_language ]));
    }

    /**
     * @param DejavuL1Language $dejavu_l1_language
     * @return JsonApiResource
     */
    public function show(DejavuL1Language $dejavu_l1_language)
    {
        return new JsonApiResource($dejavu_l1_language);
    }

    /**
     * @param UpdateDejavuL1LanguageRequest $request
     * @param DejavuL1Language $dejavu_l1_language
     * @return JsonApiResource
     */
    public function update(UpdateDejavuL1LanguageRequest $request, DejavuL1Language $dejavu_l1_language)
    {
        $dejavu_l1_language->update($request->input('data.attributes'));
        return new JsonApiResource($dejavu_l1_language);
    }

    /**
     * @param DejavuL1Language $dejavu_l1_language
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DejavuL1Language $dejavu_l1_language)
    {
        $dejavu_l1_language->delete();
        return response(null, 204);
    }
}
