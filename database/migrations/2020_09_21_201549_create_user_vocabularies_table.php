<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVocabulariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vocabularies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('part_of_speech_id')->nullable();
            $table->unsignedBigInteger('dejavu_vocabulary_id')->nullable();
            $table->unsignedBigInteger('dejavu_l2_language_id');
            $table->unsignedBigInteger('user_category_id')->nullable();
            $table->unsignedBigInteger('user_subcategory_id')->nullable();
            $table->string('vocabulary', 100);
            $table->string('cefr_level', 2)->nullable();
            $table->string('british_ipa', 100)->nullable();
            $table->string('american_ipa', 100)->nullable();
            $table->unsignedSmallInteger('corpus_frequency_level')->nullable();
            $table->timestamps();
        });

        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });

        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->foreign('part_of_speech_id')
                  ->references('id')
                  ->on('part_of_speeches')
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
        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->dropForeign('user_vocabularies_user_id_foreign');
        });

        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->dropForeign('user_vocabularies_part_of_speech_id_foreign');
        });

        Schema::dropIfExists('user_vocabularies');
    }
}
