<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddMemoryLevelDataToMemoryLevelsTable extends Migration
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
                'name' => 'Sensory memory',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'name' => 'Short-term memory',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'name' => 'Long-term memory',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('memory_levels')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('memory_levels')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '3']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE memory_levels AUTO_INCREMENT = 1');
    }
}
