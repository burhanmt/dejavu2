<?php

namespace Tests\Feature;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class InterestsTest extends TestCase
{
    use DatabaseMigrations;

    public const ENDPOINT = '/api/v1/interests/';

    /**
     *
     */
    public function testOneRecordAsResource()
    {
        $interest = Interest::factory()->make();
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
                         "type"       => Interest::typeNameConvention(),
                         "attributes" => [
                             "name" => $interest->name,
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
        $interest = Interest::factory(3)->make();
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
                'type' => Interest::typeNameConvention(),
                'attributes' => [
                    'name' => 'General',
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
                        'id' => '11',
                        'type' => Interest::typeNameConvention(),
                        'attributes' => [
                            'name' => 'General',
                            'updated_at' => $timestamp,
                            'created_at' => $timestamp
                        ]
                    ]
                ]
            )->assertHeader('Location', url(self::ENDPOINT . '11'));

        $this->assertDatabaseHas('interests', [
           'id' => 11,
           'name' => 'General',
        ]);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $interest = Interest::factory()->create();

        $this->patchJson(self::ENDPOINT . '1', [
            'data' => [
                'id' =>  '1',
                'type' => Interest::typeNameConvention(),
                'attributes' => [
                    'name' => 'Excel at work / job',
                    'created_at' => $interest->updated_at->toJSON(),
                    'updated_at' => $interest->updated_at->toJSON()
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
                        'type' => Interest::typeNameConvention(),
                        'attributes' => [
                            'name' => 'Excel at work / job',
                            'updated_at' => $interest->updated_at->toJSON(),
                            'created_at' => $interest->created_at->toJSON()
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('interests', [
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
        $interest = Interest::factory()->make();

        $this->delete(self::ENDPOINT . '1', [], [
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(204);

        $this->assertDatabaseMissing('interests', [
            'id' => 1,
            'name' => $interest->name
        ]);
    }

    public function testStoreValidation()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->postJson(self::ENDPOINT, [
            'data' => [
                'type' => Interest::typeNameConvention(),
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

        $this->assertDatabaseMissing('interests', [
            'id' => 2,
            'name' => 'Excel at work / job'
        ]);
    }

    public function testRelatedLink()
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $this->getJson(self::ENDPOINT . '1/relationships/interest-translations', [
            'accept'       => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => [
                        'id' => '1',
                        'type' => 'interest-translations'
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
            self::ENDPOINT . '1/interest-translations',
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
                            'type' => 'interest-translations',
                            'attributes' => [
                                'interest_id' => 1,
                                'dejavu_l1_language_id' => 2,
                                'name' => 'Genel'
                            ]
                        ]
                    ]
                ]
            );
    }
}
