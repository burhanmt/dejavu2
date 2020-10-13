<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDejavuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dejavu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        /**
         * if the admin delete  the dejavu category form the table,
         * the system will make the dejavu_category_id value which is related with it null.
         */
        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->foreign('dejavu_category_id')
                ->references('id')
                ->on('dejavu_categories')
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
        Schema::table('dejavu_vocabularies', function (Blueprint $table) {
            $table->dropForeign('dejavu_vocabularies_dejavu_category_id_foreign');
        });
        Schema::dropIfExists('dejavu_categories');
    }
}
