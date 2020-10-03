<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTurkishTrustLevelDataToTrustLevelTranslationsTable extends Migration
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
                'trust_level_id' => 1,
                'dejavu_l1_language_id' => 2,
                'name' => 'Düşük',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'trust_level_id' => 2,
                'dejavu_l1_language_id' => 2,
                'name' => 'Orta',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'trust_level_id' => 3,
                'dejavu_l1_language_id' => 2,
                'name' => 'Yüksek',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('trust_level_translations')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('trust_level_translations')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '3']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE trust_level_translations AUTO_INCREMENT = 1');
    }
}
