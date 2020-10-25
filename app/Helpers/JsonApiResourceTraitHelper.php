<?php


namespace App\Helpers;


use App\Http\Resources\JsonApiResource;
use Illuminate\Support\Str;

trait JsonApiResourceTraitHelper
{
    //todo-missing: I need to add some useful comments to understand this method.
    /**
     * @param string $modelClass
     * @param array $attributes
     * @param array|null $relationships
     * @return \Illuminate\Http\JsonResponse
     */
    public function createResource(string $modelClass, array $attributes, array $relationships = null)
    {
        $model = $modelClass::create($attributes);

        if ($relationships) {
            $modelRelationshipForeignKey = [Str::slug(Str::singular($model->type()), '_') . '_id' => $model->id];
            foreach ($relationships as $relationshipName => $contents) {
                $attributes = array_values($contents)[0]['data']['attributes'] ?? null;
                $relationshipClass = array_values($contents)[0]['data']['type'] ?? null;
                if (!empty($attributes) && !empty($relationshipClass)) {
                    $attributes = $modelRelationshipForeignKey + $attributes;
                    $relationshipClass = 'App\Models\\' . Str::camel(Str::slug(Str::singular($relationshipClass), '_'));

                    $relationshipClass::create($attributes);
                }
            }
        }

        return (new JsonApiResource($model))
            ->response()
            ->header('Location', route("{$model->type()}.show", [Str::slug(Str::singular($model->type()), '_')  => $model]));
    }

    //todo-missing: I need to add another method to update the relationships.
}
