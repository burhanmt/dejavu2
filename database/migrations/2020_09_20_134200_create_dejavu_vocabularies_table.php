<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_vocabularies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_of_speech_id')->nullable();
            $table->unsignedBigInteger('dejavu_l2_language_id');
            $table->unsignedBigInteger('dejavu_category_id')->nullable();
            $table->unsignedBigInteger('dejavu_subcategory_id')->nullable();
            $table->char('vocabulary', 100);
            $table->char('cefr_level', 2)->nullable();
            $table->char('british_ipa', 100)->nullable();
            $table->char('american_ipa', 100)->nullable();
            $table->unsignedSmallInteger('corpus_frequency_level')->nullable();
            $table->unsignedBigInteger('trust_level_id')->nullable();
            $table->timestamps();
        });

        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->foreign('part_of_speech_id')
                  ->references('id')
                  ->on('part_of_speeches')
                  ->nullOnDelete();
        });

        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->foreign('trust_level_id')
                  ->references('id')
                  ->on('trust_levels')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->dropForeign('dejavu_vocabularies_part_of_speech_id_foreign');
        });

        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->dropForeign('dejavu_vocabularies_trust_level_id_foreign');
        });
        Schema::dropIfExists('dejavu_vocabularies');
    }
}
