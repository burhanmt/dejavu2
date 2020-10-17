<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInterestRequest;
use App\Http\Requests\UpdateInterestRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\Interest;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class InterestsController extends Controller
{

    /**
     * InterestsController constructor.
     */
    public function __construct()
    {
        /**
         * trust_level is router parameter representative like:
         * api/v1/interest/{interest}
         */
        $this->authorizeResource(Interest::class, 'interest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = QueryBuilder::for(Interest::class)
            ->allowedSorts(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ]
            )
            ->allowedIncludes(['interestTranslations'])
            ->jsonPaginate();

        return new JsonApiCollection($interests);
    }


    /**
     * @param CreateInterestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateInterestRequest $request)
    {
        $interest = Interest::create(
            [
                'name' => $request->input('data.attributes.name'),
                'description' => $request->input('data.attributes.description'),
            ]
        );

        return (new JsonApiResource($interest))
            ->response()
            ->header('Location', route('interests.show', ['interest' => $interest]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function show(Interest $interest)
    {
        $query = QueryBuilder::for(Interest::where('id', $interest->id))
            ->allowedIncludes('interestTranslations')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateInterestRequest $request
     * @param Interest $interest
     * @return JsonApiResource
     */
    public function update(UpdateInterestRequest $request, Interest $interest)
    {
        $interest->update($request->input('data.attributes'));

        return new JsonApiResource($interest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();

        return response(null, 204);
    }
}
