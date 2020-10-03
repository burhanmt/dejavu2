<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExpressionTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_expression_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_expression_id');
            $table->unsignedBigInteger('memory_level_id')->nullable();
            $table->unsignedInteger('review_counter')->default(0);
            $table->unsignedInteger('review_exam_counter')->default(0);
            $table->unsignedInteger('speaking_practice_counter')->default(0);
            $table->datetime('evaluation_datetime');
            $table->unsignedInteger('assessment_interval')->nullable();
            $table->datetime('next_assessment_datetime');
            $table->unsignedInteger('email_sending_count')->default(0);
            $table->timestamps();
        });

        Schema::table('user_expression_trackings', function (Blueprint $table) {
            $table->foreign('user_expression_id')
                  ->references('id')
                  ->on('user_expressions')
                  ->cascadeOnDelete();
        });

        Schema::table('user_expression_trackings', function (Blueprint $table) {
            $table->foreign('memory_level_id')
                  ->references('id')
                  ->on('memory_levels')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_expression_trackings', function (Blueprint $table) {
            $table->dropForeign('user_expression_trackings_user_expression_id_foreign');
        });

        Schema::table('user_expression_trackings', function (Blueprint $table) {
            $table->dropForeign('user_expression_trackings_memory_level_id_foreign');
        });
        Schema::dropIfExists('user_expression_trackings');
    }
}
