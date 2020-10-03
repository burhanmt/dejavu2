<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTurkishInterestDataToInterestTranslationsTable extends Migration
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
                'interest_id' => 1,
                'dejavu_l1_language_id' => 2,
                'name' => 'Genel',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'interest_id' => 2,
                'dejavu_l1_language_id' => 2,
                'name' => 'İş',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'interest_id' => 3,
                'dejavu_l1_language_id' => 2,
                'name' => 'Seyahat',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4,
                'interest_id' => 4,
                'dejavu_l1_language_id' => 2,
                'name' => 'Eğitim',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 5,
                'interest_id' => 5,
                'dejavu_l1_language_id' => 2,
                'name' => 'Bilişim Dünyası',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 6,
                'interest_id' => 6,
                'dejavu_l1_language_id' => 2,
                'name' => 'Edebiyat & Sanat',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 7,
                'interest_id' => 7,
                'dejavu_l1_language_id' => 2,
                'name' => 'Tarih',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 8,
                'interest_id' => 8,
                'dejavu_l1_language_id' => 2,
                'name' => 'Teoloji (İslam)',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 9,
                'interest_id' => 9,
                'dejavu_l1_language_id' => 2,
                'name' => 'Teoloji (Hıristiyanlık)',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 10,
                'interest_id' => 10,
                'dejavu_l1_language_id' => 2,
                'name' => 'Havacılık',
                'description' => '',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('interest_translations')->insert($bulk_record);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('interest_translations')
          ->where(
              [
                  ['id', '>=', '1'],
                  ['id', '<=', '10']
              ]
          )
          ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE interest_translations AUTO_INCREMENT = 1');
    }
}
