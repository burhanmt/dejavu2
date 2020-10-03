<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuExpressionMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_expression_meanings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dejavu_expression_id');
            $table->unsignedBigInteger('dejavu_l1_language_id');
            $table->text('meaning');
            $table->timestamps();
        });

        Schema::table('dejavu_expression_meanings', function (Blueprint $table) {
            $table->foreign('dejavu_expression_id')
                  ->references('id')
                  ->on('dejavu_expressions')
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
        Schema::table('dejavu_expression_meanings', function (Blueprint $table) {
            $table->dropForeign('dejavu_expression_meanings_dejavu_expression_id_foreign');
        });
        Schema::dropIfExists('dejavu_expression_meanings');
    }
}
