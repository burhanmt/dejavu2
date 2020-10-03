<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTrustLevelDataToTrustLevelsTable extends Migration
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
                'name' => 'Low',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'name' => 'Moderate',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'name' => 'High',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('trust_levels')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('trust_levels')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '3']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE trust_levels AUTO_INCREMENT = 1');
    }
}
