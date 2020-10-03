<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goal_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('dejavu_l1_language_id');
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('goal_translations', function (Blueprint $table) {
            $table->foreign('goal_id')
               ->references('id')
               ->on('goals')
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
        Schema::table('goal_translations', function (Blueprint  $table) {
            $table->dropForeign('goal_translations_goal_id_foreign');
        });
        Schema::dropIfExists('goal_translations');
    }
}
