<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\JsonApiResourceTraitHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDejavuClientRequest;
use App\Http\Requests\UpdateDejavuClientRequest;
use App\Http\Resources\JsonApiCollection;
use App\Http\Resources\JsonApiResource;
use App\Models\DejavuClient;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class DejavuClientsController extends Controller
{
    use JsonApiResourceTraitHelper;

    /**
     * DejavuClientsController constructor.
     */
    public function __construct()
    {
        /**
         * dejavu_client is router parameter representative like:
         * api/v1/dejavu-clients/{dejavu_client}
         */
        $this->authorizeResource(DejavuClient::class, 'dejavu_client');
    }

    /**
     * @return JsonApiCollection
     */
    public function index()
    {
        $dejavuClients = QueryBuilder::for(DejavuClient::class)
            ->allowedSorts(
                [
                    'client_name',
                    'client_domain_name',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['users'])
            ->jsonPaginate();

        return new JsonApiCollection($dejavuClients);
    }

    /**
     * @param CreateDejavuClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateDejavuClientRequest $request)
    {
        return $this->createResource(
            DejavuClient::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DejavuClient  $dejavuClient
     * @return \Illuminate\Http\Response
     */
    public function show(DejavuClient $dejavuClient)
    {
        $query = QueryBuilder::for(DejavuClient::where('id', $dejavuClient->id))
            ->allowedIncludes('users')
            ->firstOrFail();

        return (new JsonApiResource($query));
    }

    /**
     * @param UpdateDejavuClientRequest $request
     * @param DejavuClient $dejavuClient
     * @return JsonApiResource
     */
    public function update(UpdateDejavuClientRequest $request, DejavuClient $dejavuClient)
    {
        $dejavuClient->update($request->input('data.attributes'));

        return new JsonApiResource($dejavuClient);
    }

    /**
     * @param DejavuClient $dejavuClient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DejavuClient $dejavuClient)
    {
        $dejavuClient->delete();

        return response(null, 204);
    }
}
