<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dejavu_category_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        /**
         * if the admin delete  the dejavu category form the table,
         * the system will make the dejavu_category_id value which is related with it null.
         */
        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->foreign('dejavu_subcategory_id')
                ->references('id')
                ->on('dejavu_subcategories')
                ->nullOnDelete();
        });

        /**
         * if the admin delete  the dejavu subcategory form the table,
         * the system will make the dejavu_subcategory_id value which is related with it null.
         */
        Schema::table('dejavu_subcategories', function (Blueprint $table) {
            $table->foreign('dejavu_category_id')
                  ->references('id')
                  ->on('dejavu_categories')
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
        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->dropForeign('dejavu_vocabularies_dejavu_subcategory_id_foreign');
        });

        Schema::table('dejavu_subcategories', function (Blueprint $table) {
            $table->dropForeign('dejavu_subcategories_dejavu_category_id_foreign');
        });
        Schema::dropIfExists('dejavu_subcategories');
    }
}
