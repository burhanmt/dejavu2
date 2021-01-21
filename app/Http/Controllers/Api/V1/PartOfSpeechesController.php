<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\JsonApiResourceTraitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePartOfSpeechRequest;
use App\Http\Requests\UpdatePartOfSpeechRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\PartOfSpeech;
use Spatie\QueryBuilder\QueryBuilder;

class PartOfSpeechesController extends Controller
{
    use JsonApiResourceTraitHelper;

    public function index()
    {
        $partOfSpeeches = QueryBuilder::for(PartOfSpeech::class)
            ->allowedSorts(
                [
                    'name',
                    'short_name',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['partOfSpeechTranslations'])
            ->jsonPaginate();

        return new JsonApiCollection($partOfSpeeches);
    }

    /**
     * @param CreatePartOfSpeechRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePartOfSpeechRequest $request)
    {
        return $this->createResource(
            PartOfSpeech::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * @param PartOfSpeech $partOfSpeech
     * @return JsonApiResource
     */
    public function show(PartOfSpeech $partOfSpeech)
    {
        $query = QueryBuilder::for(PartOfSpeech::where('id', $partOfSpeech->id))
            ->allowedIncludes('partOfSpeechTranslations')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }


    /**
     * @param UpdatePartOfSpeechRequest $request
     * @param PartOfSpeech $partOfSpeech
     * @return JsonApiResource
     */
    public function update(UpdatePartOfSpeechRequest $request, PartOfSpeech $partOfSpeech)
    {
        $partOfSpeech->update($request->input('data.attributes'));

        return new JsonApiResource($partOfSpeech);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartOfSpeech  $partOfSpeech
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartOfSpeech $partOfSpeech)
    {
        $partOfSpeech->delete();

        return response(null, 204);
    }
}
