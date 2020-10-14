<?php


namespace Tests\Feature;


use App\Models\MemoryLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class MemoryLevelsTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/memory-levels/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $memory_level = MemoryLevel::factory()->make();
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
                         "type"       => MemoryLevel::typeNameConvention(),
                         "attributes" => [
                             "name" => $memory_level->name,
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
        $memory_level = MemoryLevel::factory(3)->make();
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
                'type' => MemoryLevel::typeNameConvention(),
                'attributes' => [
                    'name' => 'Sensory memory',
                    'description' => 'test',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
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
                        'type' => MemoryLevel::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Sensory memory',
                            'description' => 'test',
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '4'));

        $this->assertDatabaseHas('memory_levels', [
           'id' => 4,
           'name' => 'Sensory memory',
           'description' => 'test'
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $memory_level = MemoryLevel::factory()->create();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => MemoryLevel::typeNameConvention(),
                'attributes' => [
                    'name' => 'Sensory memory',
                    'created_at' => $memory_level->updated_at->toJSON(),
                    'updated_at' => $memory_level->updated_at->toJSON()
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
                        'type' => MemoryLevel::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Sensory memory',
                            'updated_at' => $memory_level->updated_at->toJSON(),
                            'created_at' => $memory_level->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('memory_levels', [
            'id' => 1,
            'name' => 'Sensory memory'
        ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $memory_level = MemoryLevel::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('memory_levels', [
            'id' => 1,
            'name' => $memory_level->name
        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => MemoryLevel::typeNameConvention(),
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

        $this->assertDatabaseMissing('memory_levels', [
            'id' => 2,
            'name' => 'Sensory memory'
        ]);
    }

    public function testRelatedLink()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1/relationships/memory-level-translations', [
            'accept'       => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                        'id' => '1',
                        'type' => 'memory-level-translations'
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
            self::ENDPOINT . '1/memory-level-translations',
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
                            'type' => 'memory-level-translations',
                            'attributes' => [
                                'memory_level_id' => 1,
                                'dejavu_l1_language_id' => 2,
                                'name' => 'Duyusal hafıza'
                            ]
                        ]
                    ]
                ]
            );
    }
}
