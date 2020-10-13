<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuExpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_expressions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dejavu_l2_language_id');
            $table->unsignedBigInteger('dejavu_category_id')->nullable();
            $table->unsignedBigInteger('dejavu_subcategory_id')->nullable();
            $table->string('expression', 255);
            $table->unsignedBigInteger('trust_level_id')->nullable();
            $table->timestamps();
        });

        /**
         * if the admin delete  the dejavu category form the table,
         * the system will make the dejavu_category_id value which is related with it null.
         */
        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->foreign('dejavu_category_id')
                  ->references('id')
                  ->on('dejavu_categories')
                  ->nullOnDelete();
        });

        /**
         * if the admin delete  the dejavu subcategory form the table,
         * the system will make the dejavu_subcategory_id value which is related with it null.
         */
        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->foreign('dejavu_subcategory_id')
                  ->references('id')
                  ->on('dejavu_subcategories')
                  ->nullOnDelete();
        });

        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->foreign('trust_level_id')
                  ->references('id')
                  ->on('trust_levels')
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
        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->dropForeign('dejavu_expressions_dejavu_category_id_foreign');
        });

        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->dropForeign('dejavu_expressions_dejavu_subcategory_id_foreign');
        });

        Schema::table('dejavu_expressions', function (Blueprint $table) {
            $table->dropForeign('dejavu_expressions_trust_level_id_foreign');
        });
        Schema::dropIfExists('dejavu_expressions');
    }
}
