<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddInterestDataToInterestsTable extends Migration
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
                'name' => 'General',
                'enabled' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'name' => 'Business',
                'enabled' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'name' => 'Travel',
                'enabled' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4,
                'name' => 'Education',
                'enabled' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 5,
                'name' => 'Information Technology',
                'enabled' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 6,
                'name' => 'Art & Literature',
                'enabled' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 7,
                'name' => 'History',
                'enabled' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 8,
                'name' => 'Theology(Islam)',
                'enabled' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 9,
                'name' => 'Theology(Christianity)',
                'enabled' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 10,
                'name' => 'Aviation',
                'enabled' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('interests')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('interests')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '10']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE interests AUTO_INCREMENT = 1');
    }
}
