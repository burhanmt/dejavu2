<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class JsonApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'type' => $this->type(),
            'attributes' => $this->allowedAttributes(),
            'relationships' => $this->prepareRelationships(),
        ];
    }

    private function prepareRelationships()
    {
        return collect(config("jsonapi.resources.{$this->type()}.relationships"))
            ->flatMap(function ($related) {
                $relatedType = $related['type'];
                $relationship = $related['method'];
                $model = $related['model'];
                return [
                    $relatedType => [
                        'self'    => route(
                            "{$this->type()}.relationships.{$relatedType}",
                            [$model => $this->id]
                        ),
                        'related' => route(
                            "{$this->type()}.{$relatedType}",
                            [$model => $this->id]
                        ),
                        'data' => $this->prepareRelationshipData($relatedType, $relationship),

                    ]
                ];
            });
    }
    private function prepareRelationshipData($relatedType, $relationship)
    {
        if ($this->whenLoaded($relationship) instanceof MissingValue) {
            return new MissingValue();
        }

        if ($this->$relationship instanceof BelongsTo) {
            return new JSONAPIIdentifierResource($this->$relationship);
        }

        return JSONAPIIdentifierResource::collection($this->$relationship);
    }
    public function with($request)
    {
        $with = [];
        if ($this->included($request)->isNotEmpty()) {
            $with['included'] = $this->included($request);
        }

        return $with;
    }

    public function included($request)
    {
        return collect($this->relations())
            ->filter(function ($resource) {
                return $resource->collection !== null;
            })->flatMap->toArray($request);
    }

    private function relations()
    {
        return collect(config("jsonapi.resources.{$this->type()}.relationships"))
            ->map(function ($relation) {
                return JsonApiResource::collection($this->whenLoaded($relation['method']));
            });
    }
}
