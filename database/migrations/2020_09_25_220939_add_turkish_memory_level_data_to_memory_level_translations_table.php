<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTurkishMemoryLevelDataToMemoryLevelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  'dejavu_l1_language_id' => 2, Turkish
         */
        $timestamp = Carbon::now()->toDateTimeString();
        $bulk_record = [
            [
                'id' => 1,
                'memory_level_id' => 1,
                'dejavu_l1_language_id' => 2,
                'name' => 'Duyusal hafıza',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'memory_level_id' => 2,
                'dejavu_l1_language_id' => 2,
                'name' => 'Kısa dönem hafıza',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'memory_level_id' => 3,
                'dejavu_l1_language_id' => 2,
                'name' => 'Uzun dönem hafıza',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('memory_level_translations')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('memory_level_translations')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '3']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE memory_level_translations AUTO_INCREMENT = 1');
    }
}
