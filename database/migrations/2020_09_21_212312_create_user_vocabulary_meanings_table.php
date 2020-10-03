<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVocabularyMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vocabulary_meanings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_vocabulary_id');
            $table->char('meaning', 255);
            $table->timestamps();
        });

        Schema::table('user_vocabulary_meanings', function (Blueprint $table) {
            $table->foreign('user_vocabulary_id')
                ->references('id')
                ->on('user_vocabularies')
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
        Schema::table('user_vocabulary_meanings', function (Blueprint $table) {
            $table->dropForeign('user_vocabulary_meanings_user_vocabulary_id_foreign');
        });
        Schema::dropIfExists('user_vocabulary_meanings');
    }
}
