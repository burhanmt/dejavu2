<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVocabularyMnemonicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vocabulary_mnemonics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_vocabulary_id');
            $table->text('sentence');
            $table->timestamps();
        });

        Schema::table('user_vocabulary_mnemonics', function (Blueprint $table) {
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
        Schema::table('user_vocabulary_mnemonics', function (Blueprint $table) {
            $table->dropForeign('user_vocabulary_mnemonics_user_vocabulary_id_foreign');
        });
        Schema::dropIfExists('user_vocabulary_mnemonics');
    }
}
