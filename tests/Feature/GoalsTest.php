<?php

namespace Tests\Feature;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GoalsTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/goals/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $goal = Goal::factory()->make();
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
                         "type"       => Goal::typeNameConvention(),
                         "attributes" => [
                             "name" => $goal->name,
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
        $goal = Goal::factory(3)->make();
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
                'type' => Goal::typeNameConvention(),
                'attributes' => [
                    'name' => 'Excel at work / job',
                    'description' => 'Excel at work / job',
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
                        'id' => '6',
                        'type' => Goal::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Excel at work / job',
                            'description' => 'Excel at work / job',
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '6'));

        $this->assertDatabaseHas('goals', [
           'id' => 6,
           'name' => 'Excel at work / job',
           'description' => 'Excel at work / job'
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $goal = Goal::factory()->create();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => Goal::typeNameConvention(),
                'attributes' => [
                    'name' => 'Excel at work / job',
                    'created_at' => $goal->updated_at->toJSON(),
                    'updated_at' => $goal->updated_at->toJSON()
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
                        'type' => Goal::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Excel at work / job',
                            'updated_at' => $goal->updated_at->toJSON(),
                            'created_at' => $goal->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('goals', [
            'id' => 1,
            'name' => 'Excel at work / job'
        ]);
    }

    /**
     *
     */
    public function testDelete()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $goal = Goal::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('goals', [
            'id' => 1,
            'name' => $goal->name
        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => Goal::typeNameConvention(),
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

        $this->assertDatabaseMissing('goals', [
            'id' => 2,
            'name' => 'Excel at work / job'
        ]);
    }

    public function testRelatedLink()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1/relationships/goal-translations', [
            'accept'       => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                        'id' => '1',
                        'type' => 'goal-translations'
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
            self::ENDPOINT . '1/goal-translations',
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
                            'type' => 'goal-translations',
                            'attributes' => [
                                'goal_id' => 1,
                                'dejavu_l1_language_id' => 2,
                                'name' => 'İşimde iyi olmak için'
                            ]
                        ]
                    ]
                ]
            );
    }
}
