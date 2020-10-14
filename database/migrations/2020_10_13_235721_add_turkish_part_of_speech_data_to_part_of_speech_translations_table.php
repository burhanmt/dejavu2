<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AddTurkishPartOfSpeechDataToPartOfSpeechTranslationsTable extends Migration
{
    public function up()
    {
        /**
         *  'dejavu_l1_language_id' => 2, Turkish
         */
        $timestamp   = Carbon::now()
            ->toDateTimeString();
        $bulk_record = [
            [
                'id'                    => 1,
                'part_of_speech_id'     => 1,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'İsim',
                'short_name'            => 'İ.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 2,
                'part_of_speech_id'     => 2,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Fiil',
                'short_name'            => 'F.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 3,
                'part_of_speech_id'     => 3,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Sıfat',
                'short_name'            => 'S.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 4,
                'part_of_speech_id'     => 4,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Zarf',
                'short_name'            => 'Z.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 5,
                'part_of_speech_id'     => 5,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Zamir',
                'short_name'            => 'Zam.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 6,
                'part_of_speech_id'     => 6,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Edat',
                'short_name'            => 'Ed.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 7,
                'part_of_speech_id'     => 7,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Bağlaç',
                'short_name'            => 'Bağ.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 8,
                'part_of_speech_id'     => 8,
                'dejavu_l1_language_id' => 2,
                'name'                  => 'Ünlem',
                'short_name'            => 'Ün.',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],
            [
                'id'                    => 9,
                'part_of_speech_id'     => 9,
                'dejavu_l1_language_id' => 2,
                'name'                  => '-',
                'short_name'            => '-',
                'created_at'            => $timestamp,
                'updated_at'            => $timestamp
            ],

        ];

        DB::table('part_of_speech_translations')
            ->insert($bulk_record);
    }

    public function down()
    {
        // Remove the records
        DB::table('part_of_speech_translations')
            ->where(
                [
                    ['id', '>=', '1'],
                    ['id', '<=', '9']
                ]
            )
            ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE part_of_speech_translations AUTO_INCREMENT = 1');
    }
}