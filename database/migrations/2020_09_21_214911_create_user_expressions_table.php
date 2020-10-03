<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_expressions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dejavu_expression_id')->nullable();
            $table->unsignedBigInteger('dejavu_l2_language_id');
            $table->unsignedBigInteger('user_category_id')->nullable();
            $table->unsignedBigInteger('user_subcategory_id')->nullable();
            $table->char('expression', 255);
            $table->timestamps();
        });

        Schema::table('user_expressions', function (Blueprint $table) {
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
        Schema::table('user_expressions', function (Blueprint $table) {
            $table->dropForeign('user_expressions_user_id_foreign');
        });

        Schema::dropIfExists('user_expressions');
    }
}
