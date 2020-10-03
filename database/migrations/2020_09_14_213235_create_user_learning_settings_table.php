<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLearningSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_learning_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dejavu_l1_language_id');
            $table->unsignedBigInteger('dejavu_l2_language_id');
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('interest_id');
            $table->timestamps();
        });

        Schema::table('user_learning_settings', function (Blueprint $table) {
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
        Schema::table('user_learning_settings', function (Blueprint $table) {
            $table->dropForeign('user_learning_settings_user_id_foreign');
        });

        Schema::dropIfExists('user_learning_settings');
    }
}
