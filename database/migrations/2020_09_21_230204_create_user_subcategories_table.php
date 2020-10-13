<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_category_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        /**
         * if the admin delete  the user subcategory form the table,
         * the system will make the user_subcategory_id value which is related with it null.
         */
        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->foreign('user_subcategory_id')
                  ->references('id')
                  ->on('user_subcategories')
                  ->nullOnDelete();
        });

        /**
         * if the admin delete  the user subcategory form the table,
         * the system will make the user_subcategory_id value which is related with it null.
         */
        Schema::table('user_subcategories', function (Blueprint $table) {
            $table->foreign('user_category_id')
                  ->references('id')
                  ->on('user_categories')
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
        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->dropForeign('user_vocabularies_user_subcategory_id_foreign');
        });

        Schema::table('user_subcategories', function (Blueprint $table) {
            $table->dropForeign('user_subcategories_user_category_id_foreign');
        });
        Schema::dropIfExists('user_subcategories');
    }
}
