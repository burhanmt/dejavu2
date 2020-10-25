<?php

namespace Tests\Feature;

use App\Models\DejavuClient;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DejavuClientsTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/dejavu-clients/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $dejavuClient = DejavuClient::factory()->make();
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1', [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
             ->assertJson(
                 [
                     "data" => [
                         "id"         => '1',
                         "type"       => DejavuClient::typeNameConvention(),
                         "attributes" => [
                             "client_name" => $dejavuClient->client_name,
                             'enabled' => 1,
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
        $trust_levels = DejavuClient::factory(3)->make();
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
                'type' => DejavuClient::typeNameConvention(),
                'attributes' => [
                    'client_name' => 'Dejavu Users',
                    'enabled' => 1,
                ]
            ]
        ], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'id' => '2',
                        'type' => DejavuClient::typeNameConvention(),
                        'attributes' => [
                            'client_name' => 'Dejavu Users',
                            'enabled' => 1,
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '2'));

        $this->assertDatabaseHas('dejavu_clients', [
           'id' => 2,
           'client_name' => 'Dejavu Users',
           'enabled' => 1,
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $dejavuClient = DejavuClient::factory()->make();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => DejavuClient::typeNameConvention(),
                'attributes' => [
                    'client_name' => 'Dejavu Users',
                    'enabled' => 1,
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
                        'type' => DejavuClient::typeNameConvention(),
                        'attributes' => [
                            'client_name' => 'Dejavu Users',
                            'enabled' => 1,
                            'updated_at' => $dejavuClient->updated_at->toJSON(),
                            'created_at' => $dejavuClient->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('dejavu_clients', [
            'id' => 1,
            'client_name' => 'Dejavu Users',
            'enabled' => 1,
        ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $dejavuClient = DejavuClient::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('dejavu_clients', [
            'id' => 1,
            'client_name' => $dejavuClient->client_name,
            'enabled' => 1,

        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => DejavuClient::typeNameConvention(),
                'attributes' => [
                    'client_name' => '', // Make it empty to test the validation. Because it is mandatory field.
                    'enabled' => 1,
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
                           'details' => 'The data.attributes.client name field is required.',
                           'source' => [
                               'pointer' => '/data/attributes/client_name'
                           ]
                       ]
                    ]
                ]
            );

        $this->assertDatabaseMissing('dejavu_clients', [
            'id' => 2,
            'client_name' => 'Dejavu Users'
        ]);
    }

    public function testRelatedLink()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1/relationships/users', [
            'accept'       => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                        'id' => '1',
                        'type' => 'users'
                        ]
                    ]
                ]
            );
    }

    public function testSelfLink()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $this->getJson(
            self::ENDPOINT . '1/users',
            [
                'accept'       => 'application/vnd.api+json',
                'content-type' => 'application/vnd.api+json'
            ]
        )->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                            'id'   => '1',
                            'type' => 'users',
                            'attributes' => [
                                'uuid' => 'ca2e3750-0da5-11eb-8d8c-1f5f833dd7a2',
                                'name' => $user->name,
                                'family_name' => $user->family_name,
                                'email' => $user->email,
                                'email_verified_at' => $user->email_verified_at->format('Y-m-d H:i:s'),
                                'role' => $user->role,
                                'timezone' => $user->timezone,
                                'created_at' => $user->created_at->toJson(),
                                'updated_at' => $user->updated_at->toJson(),
                                'dejavu_client_id' => $user->dejavu_client_id

                            ]
                        ]
                    ]
                ]
            );
    }
}
