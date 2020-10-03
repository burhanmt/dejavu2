<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartOfSpeechTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_of_speech_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_of_speech_id');
            $table->unsignedBigInteger('dejavu_l1_language_id');
            $table->string('name', 50);
            $table->string('short_name', 10);
            $table->timestamps();
        });

        Schema::table('part_of_speech_translations', function (Blueprint $table) {
            $table->foreign('part_of_speech_id')
                ->references('id')
                ->on('part_of_speeches')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('part_of_speech_translations', function (Blueprint $table) {
            $table->dropForeign('part_of_speech_translations_part_of_speech_id_foreign');
        });
        Schema::dropIfExists('part_of_speech_translations');
    }
}
