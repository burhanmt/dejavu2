## About Project
Dejavu English is a vocabulary builder application that helps the users to learn more vocabularies by using ML and AI.
Each vocabulary individually traces to find out the retention interval of the user.
The goal of the program is making the user's vocabularies from Sensory memory to Long-term memory.

Larave 8 was used for the project. This repo is all about the API only. It represents business logic of the project. The application logic and business logic
are strictly separated. The application (web, mobile) will be developed later.

## Code Standards
PSR-12 for coding standard, PSR-4 for namespace conventions is followed up.

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

## Roles
I prefer static pre-created roles. Because of the simplicity. You can find all roles in
the **config/roles.php** file and then there is a helper trait which is  **app/Helpers/UserRoleTraitHelper.php**
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
1. composer install
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
...