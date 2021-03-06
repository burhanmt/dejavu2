<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuVocabularyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_vocabulary_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dejavu_vocabulary_id');
            $table->string('image_location');
            $table->timestamps();
        });

        Schema::table('dejavu_vocabulary_images', function (Blueprint $table) {
            $table->foreign('dejavu_vocabulary_id')
                  ->references('id')
                  ->on('dejavu_vocabularies')
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
        Schema::table('dejavu_vocabulary_images', function (Blueprint $table) {
            $table->dropForeign('dejavu_vocabulary_images_dejavu_vocabulary_id_foreign');
        });
        Schema::dropIfExists('dejavu_vocabulary_images');
    }
}
