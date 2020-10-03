<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTurkishGoalDataToGoalTranslationsTable extends Migration
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
                'goal_id' => 1,
                'dejavu_l1_language_id' => 2,
                'name' => 'İşimde iyi olmak için',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'goal_id' => 2,
                'dejavu_l1_language_id' => 2,
                'name' => 'Yurtdışında çalışmak için',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'goal_id' => 3,
                'dejavu_l1_language_id' => 2,
                'name' => 'İş mülakatını geçmek için',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4,
                'goal_id' => 4,
                'dejavu_l1_language_id' => 2,
                'name' => 'Sınavda başarılı olmak için',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 5,
                'goal_id' => 5,
                'dejavu_l1_language_id' => 2,
                'name' => 'Kendimi geliştirmek için',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('goal_translations')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('goal_translations')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '5']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE goal_translations AUTO_INCREMENT = 1');
    }
}
