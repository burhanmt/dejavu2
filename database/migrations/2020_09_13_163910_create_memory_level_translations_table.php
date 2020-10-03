<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoryLevelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memory_level_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memory_level_id');
            $table->unsignedBigInteger('dejavu_l1_language_id');
            $table->string('name', 50);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('memory_level_translations', function (Blueprint $table) {
            $table->foreign('memory_level_id')
               ->references('id')
               ->on('memory_levels')
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
        Schema::table('memory_level_translations', function (Blueprint $table) {
            $table->dropForeign('memory_level_translations_memory_level_id_foreign');
        });
        Schema::dropIfExists('memory_level_translations');
    }
}
