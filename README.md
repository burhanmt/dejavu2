## About the Project
Dejavu is a platform that consists of smart vocabulary builder application as a service. It helps the users to learn more vocabularies by using ML and AI.
Initially it will support English and Turkish for both L1 and L2 learners. Each vocabulary individually is traced to find out the retention interval of the user by Dejavu.
The goal of the program is making the user's vocabularies from Sensory memory level to Long-term memory level.

Laravel 8 is used for the project. This repo is all about the API only. It represents the business logic of the project. The application logic and business logic
are strictly separated. The application (web, mobile) will be developed later by consuming this API.

## Code Standards
PSR-12 for coding standard, PSR-4 for namespace convention standard is followed.

## JSON API Specification
I strictly followed JSON API specification for the JSON format. Look at [here](https://jsonapi.org/format/) for more info. 
## Folder Structure
- **Models** --> All models
- **Api Controllers** --> app/Http/Controllers/Api/V1
- **Requests** --> app/Http/Requests
- **Resources** --> I simplified resources, therefore All resources are dynamic to adapt the models.
"JsonApiCollection.php", "JsonApiResource.php", "JsonApiIdentifierResource.php".
- **Policies** --> app/Http/Policies
- **Model's relationships configurations** --> config/jsonapi.php
- **All roles** --> "config/roles.php"  and "app/Helpers/UserRoleTraitHelper.php"  
- **Database** --> All migrations file are there
- **tests** --> All tests stuff are there.
- **routes** --> All API routes are in the routes/api.php

## Roles

No need to spend much more time for the dynamic role system, therefore I preferred static pre-created roles. 
Because of the simplicity. You can find all roles in
the **config/roles.php** file and there is a helper trait which is  **app/Helpers/UserRoleTraitHelper.php**
and **app/Models/User.php** is using this role helper trait. It gives us flexibility to access
the user's role by using policies which are in **app/Policies/** folder.

For instance:
```
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }
```

## First Installation of the Platform
1. composer update
2. npm i
3. npm run dev
4. php artisan migrate
5. php artisan setup:dejavu
6. php artisan passport:install
7. After creating the passport stuff, get client id: 2's secret code, then put it into
**.env** file.

For instance - be sure the fields which are below not empty:
```
APP_URL=http://dejavu2.test
APP_OAUTH_CLIENT_ID=2
APP_OAUTH_SECRET=v3V7rBun0KlFW3M8IqIMHzdcfkSe4ouPvBaQTfzQ
```

## How to create a new model for future development.
### 1. php artisan make:model -a -r ModelName

**Explanation:** 

The "-a" flag will tell the artisan to create  "a model", "a database migration", "a factory" and "a controller".
The -r flag tells the generation of the controller to create a resource controller. What this means is that the
controller will contain methods for each REST verb from the beginning. You can do this when creating controllers as
well, and even give an –api flag that removes the methods for edit and create, since these are used to show the creation
and edit views in a regular/non-API application.

### 2. Let's say we created a model as "TrustLevel.php" like below:
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrustLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
```

Change the codes above with this:
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrustLevel extends AbstractApiModel
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
```
The important thing is that one:
```
class TrustLevel extends AbstractApiModel
```

### 3. After that add the 2 methods which are below to the model.

```
    /**
     * "type" name convention method. It is based on route name.
     *
     * @return false|string
     */
    public static function typeNameConvention()
    {
        return 'trust-levels';
    }

    /**
     * It is mandatory field for JSON:API specification, therefore I use route name as type.
     *
     * @return false|string
     */
    public function type()
    {
        return self::typeNameConvention();
    }
```

### 4. If there is a relationship, add it to the model like below:

```
    /**
     * A trust level record can have many translations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trustLevelTranslations()
    {
        return $this->hasMany(TrustLevelTranslation::class);
    }
```

### 5. Do not forget to add the relationship method name and others to the relationship settings which is in "config/jsonapi.php":

```
<?php

return [
    'resources' => [
        'trust-levels' => [ 
            'relationships' => [
                [
                    'type' => 'trust-level-translations', //route name
                    'method' => 'trustLevelTranslations', //relationship method name
                    'model' => 'trust_level' // modal name but snake case
                ]
            ]
        ],
];

```

### 6. Now It is the time to prepare the controller (_Controllers/Api/V1/TrustLevelsController.php_) for JSON:API specification like below:

Do not forget this trait to the controller class.
```
    use JsonApiResourceTraitHelper;
```

```
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
        $trustLevels = QueryBuilder::for(TrustLevel::class)
            ->allowedSorts(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ]
            )->allowedIncludes(['trustLevelTranslations'])
             ->jsonPaginate();

        return new JsonApiCollection($trustLevels);
    }

    /**
     * @param CreateTrustLevelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTrustLevelRequest $request)
    {
        return $this->createResource(
            TrustLevel::class,
            $request->input('data.attributes'),
            $request->input('data.relationships'),
        );
    }

    /**
     * This method supports translation of the trust_level if you use ?translate=<dejavu_l1_language_id>
     *
     * @param TrustLevel $trustLevel
     * @param Request $request
     * @return JsonApiResource
     */
    public function show(TrustLevel $trustLevel, Request $request)
    {
        $query = QueryBuilder::for(TrustLevel::where('id', $trustLevel->id))
            ->allowedIncludes('trustLevelTranslations')
            ->firstOrFail();

        $translationArray = [];
        if ($request->has('translate')) {
            $get_translation = $trustLevel->getTranslation($request->input('translate'));
            if (!empty($get_translation)) {
                $translationArray = ['meta' => [
                'translation' => $get_translation,
                'dejavu_l1_language_id' => $request->input('translate')
                ]];
            }
        }
        
        return (new JsonApiResource($query))
            ->additional($translationArray);
    }

    /**
     * @param UpdateTrustLevelRequest $request
     * @param TrustLevel $trustLevel
     * @return JsonApiResource
     */
    public function update(UpdateTrustLevelRequest $request, TrustLevel $trustLevel)
    {
        $trustLevel->update($request->input('data.attributes'));

        return new JsonApiResource($trustLevel);
    }

    /**
     * @param TrustLevel $trustLevel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TrustLevel $trustLevel)
    {
        $trustLevel->delete();

        return response(null, 204);
    }
}
```
Yes just pay attention the method arguments. There are requests. We created dedicated requests for them to validate the requests. Like "**CreateTrustLevelRequest**"
```
    public function store(CreateTrustLevelRequest $request)
```

### 7. If you pay attention the controller which is above, we should create "Requests" as well:

```
php artisan make:request CreateTrustLevelRequest
```
And write the validation logic like below: (_It is for CreateTrustLevelRequest_)

```
<?php

namespace App\Http\Requests;

use App\Models\TrustLevel;
use Illuminate\Foundation\Http\FormRequest;

class CreateTrustLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.type' => 'required|in:' . TrustLevel::typeNameConvention(),
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'required|string|max:50'
        ];
    }
}
```

And write the validation logic like below: (_It is for UpdateTrustLevelRequest_)
```
<?php

namespace App\Http\Requests;

use App\Models\TrustLevel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrustLevelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:' . TrustLevel::typeNameConvention(),
            'data.attributes' => 'sometimes|required|array',
            'data.attributes.name' => 'sometimes|required|string|max:50',
        ];
    }
}
```
### 8. Finally, we can create policies for the model and controller to manage the roles.

```
 php artisan make:policy TrustLevelPolicy --model=TrustLevel
```
Laravel easily apply the rules for the controller through the name convention. Add some codes like below in the methods:

```
<?php

namespace App\Policies;

use App\Models\TrustLevel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrustLevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function view(User $user, TrustLevel $trustLevel)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function update(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformStaff();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function delete(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformMaster();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function restore(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformAdmins() || $user->isPlatformModerator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TrustLevel  $trustLevel
     * @return mixed
     */
    public function forceDelete(User $user, TrustLevel $trustLevel)
    {
        return $user->isPlatformMaster();
    }
}
```

### 9. After creating the policy, open TrustLevelsController.php, then apply the policy for it via __construct() method like this:
```
    /**
     * TrustLevelsController constructor.
     */
    public function __construct()
    {
        /**
         * trust_level is router parameter representative like:
         * api/v1/trust-levels/{trust_level}
         */
        $this->authorizeResource(TrustLevel::class, 'trust_level');
    }
```
### 10. If everything is done, we can create routes in the "routes/api.php" like that:
```
    // TrustLevels
    Route::apiResource(
        'trust-levels',
        'TrustLevelsController'
    );
```
We should create the relationships route separately like that:
```
    Route::get('trust-levels/{trust_level}/relationships/trust-level-translations', 'TrustLevelsTrustLevelTranslationsRelationshipsController@index')
        ->name('trust-levels.relationships.trust-level-translations');
    Route::get('trust-levels/{trust_level}/trust-level-translations', 'TrustLevelsTrustLevelTranslationsRelatedController@index')
        ->name('trust-levels.trust-level-translations');
```
**That's all!**
