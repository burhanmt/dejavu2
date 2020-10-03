<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLearningProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_learning_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('vocabulary_retention')->nullable();
            $table->char('cefr_level', 2); // The Common European Framework (CEFR)
            $table->timestamps();
        });

        Schema::table('user_learning_profiles', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::table('user_learning_profiles', function (Blueprint $table) {
            $table->dropForeign('user_learning_profiles_user_id_foreign');
        });

        Schema::dropIfExists('user_learning_profiles');
    }
}
