<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddPartOfSpeechDataToPartOfSpeechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $bulk_record = [
            [
                'id' => 1,
                'name' => 'Noun',
                'short_name' => 'N.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'name' => 'Verb',
                'short_name' => 'V.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'name' => 'Adjective',
                'short_name' => 'Adj.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4,
                'name' => 'Adverb',
                'short_name' => 'Adv.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 5,
                'name' => 'Pronoun',
                'short_name' => 'Pron.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 6,
                'name' => 'Preposition',
                'short_name' => 'Prep.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 7,
                'name' => 'Conjunction',
                'short_name' => 'Conj.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 8,
                'name' => 'Interjection',
                'short_name' => 'Interj.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 9,
                'name' => 'Determiner',
                'short_name' => 'Det.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('part_of_speeches')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('part_of_speeches')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '9']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE part_of_speeches AUTO_INCREMENT = 1');
    }
}
