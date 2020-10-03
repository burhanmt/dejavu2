<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddDejavuL1LanguageDataToDejavuL1LanguagesTable extends Migration
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
                'name' => 'English',
                'short_name' => 'EN',
                'interface_language_support' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'name' => 'Turkish',
                'short_name' => 'TR',
                'interface_language_support' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('dejavu_l1_languages')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('dejavu_l1_languages')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '2']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE dejavu_l1_languages AUTO_INCREMENT = 1');
    }
}
