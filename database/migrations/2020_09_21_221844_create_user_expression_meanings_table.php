<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExpressionMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_expression_meanings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_expression_id');
            $table->char('meaning', 255);
            $table->timestamps();
        });

        Schema::table('user_expression_meanings', function (Blueprint $table) {
            $table->foreign('user_expression_id')
                  ->references('id')
                  ->on('user_expressions')
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
        Schema::table('user_expression_meanings', function (Blueprint $table) {
            $table->dropForeign('user_expression_meanings_user_expression_id_foreign');
        });
        Schema::dropIfExists('user_expression_meanings');
    }
}
