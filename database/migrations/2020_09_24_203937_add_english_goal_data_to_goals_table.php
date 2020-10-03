<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class AddEnglishGoalDataToGoalsTable extends Migration
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
               'id'          => 1,
                'name'        => 'Excel at work / job',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id'          => 2,
                'name'        => 'Study abroad',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id'          => 3,
                'name'        => 'Pass an interview',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id'          => 4,
                'name'        => 'Pass a test',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id'          => 5,
                'name'        => 'Self-improvement',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ];

        DB::table('goals')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('goals')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '5']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE goals AUTO_INCREMENT = 1');
    }
}
