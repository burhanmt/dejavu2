<?php


namespace Tests\Feature;

use App\Models\TrustLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TrustLevelsTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/trust-levels/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $trust_levels = TrustLevel::factory()->make();
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
                         "type"       => TrustLevel::typeNameConvention(),
                         "attributes" => [
                             "name" => $trust_levels->name,
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
        $trust_levels = TrustLevel::factory(3)->make();
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
                'type' => TrustLevel::typeNameConvention(),
                'attributes' => [
                    'name' => 'Moderate',
                ]
            ]
        ], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'id' => '4',
                        'type' => TrustLevel::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Moderate',
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '4'));

        $this->assertDatabaseHas('trust_levels', [
           'id' => 2,
           'name' => 'Moderate'
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $trust_level = TrustLevel::factory()->make();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => TrustLevel::typeNameConvention(),
                'attributes' => [
                    'name' => 'Low Level'
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
                        'type' => TrustLevel::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Low Level',
                            'updated_at' => $trust_level->updated_at->toJSON(),
                            'created_at' => $trust_level->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('trust_levels', [
            'id' => 1,
            'name' => 'Low Level'
        ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $trust_level = TrustLevel::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('trust_levels', [
            'id' => 1,
            'name' => $trust_level->name
        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => TrustLevel::typeNameConvention(),
                'attributes' => [
                    'name' => '', // Make it empty to test the validation. Because it is mandatory field.
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
                           'details' => 'The data.attributes.name field is required.',
                           'source' => [
                               'pointer' => '/data/attributes/name'
                           ]
                       ]
                    ]
                ]
            );

        $this->assertDatabaseMissing('trust_levels', [
            'id' => 4,
            'name' => 'Moderate'
        ]);
    }

    public function testRelatedLink()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1/relationships/trust-level-translations', [
            'accept'       => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                        'id' => '1',
                        'type' => 'trust-level-translations'
                        ]
                    ]
                ]
            );
    }

    public function testSelfLink()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(
            self::ENDPOINT . '1/trust-level-translations',
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
                            'type' => 'trust-level-translations',
                            'attributes' => [
                                'trust_level_id' => 1,
                                'dejavu_l1_language_id' => 2,
                                'name' => 'Düşük'

                            ]
                        ]
                    ]
                ]
            );
    }
}
