<?php


namespace Tests\Feature;

use App\Models\DejavuL2Language;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DejavuL2LanguagesTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/dejavu-l2-languages/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $dejavu_l2_language = DejavuL2Language::factory()->make();
        $user               = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1', [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
             ->assertJson(
                 [
                     "data" => [
                         "id" => '1',
                         "type" => DejavuL2Language::typeNameConvention(),
                         "attributes" => [
                             "name" => $dejavu_l2_language->name,
                             "short_name" => $dejavu_l2_language->short_name
                         ]
                     ]
                 ]
             );
    }

    /**
     *
     */
    public function testAllRecordsAsCollection()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $dejavu_l2_languages = DejavuL2Language::factory(3)->make();
        $this->getJson(self::ENDPOINT, [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200);
    }

    /**
     *
     */
    public function testStore()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $timestamp = now()
            ->setMilliseconds(0)
            ->toJSON();
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => DejavuL2Language::typeNameConvention(),
                'attributes' => [
                    'name' => 'Spanish',
                    'short_name' => 'SP'
                ]
            ]
        ], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'id' => '3',
                        'type' => DejavuL2Language::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Spanish',
                            'short_name' => 'SP',
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '3'));

        $this->assertDatabaseHas('dejavu_l2_languages', [
           'id' => 3,
           'name' => 'Spanish'
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $dejavu_l2_language = DejavuL2Language::factory()->make();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => DejavuL2Language::typeNameConvention(),
                'attributes' => [
                    'name' => 'English-Muck'
                ]
            ]
        ], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        'id' => '1',
                        'type' => DejavuL2Language::typeNameConvention(),
                        'attributes' => [
                            'name' => 'English-Muck',
                            'short_name' => 'EN',
                            'updated_at' => $dejavu_l2_language->updated_at->toJSON(),
                            'created_at' => $dejavu_l2_language->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('dejavu_l2_languages', [
            'id' => 1,
            'name' => 'English-Muck'
        ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $dejavu_l2_language = DejavuL2Language::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('dejavu_l2_languages', [
            'id' => 1,
            'name' => $dejavu_l2_language->name
        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => DejavuL2Language::typeNameConvention(),
                'attributes' => [
                    'name' => 'Spanish',
                    'short_name' => 'SPAAA', // Max: 3 but we put more than 3 for test purpose
                ]
            ]
        ], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(422)
            ->assertJson(
                [
                    'errors' => [
                       0 => [ 'title' => 'Validation Error',
                           'details' => 'The data.attributes.short name may not be greater than 3 characters.',
                           'source' => [
                               'pointer' => '/data/attributes/short_name'
                           ]
                       ]
                    ]
                ]
            );

        $this->assertDatabaseMissing('dejavu_l2_languages', [
            'id' => 3,
            'name' => 'Spanish'
        ]);
    }
}
