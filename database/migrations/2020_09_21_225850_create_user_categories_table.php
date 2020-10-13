<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        /**
         * if the admin delete  the user category form the table,
         * the system will make the user_category_id value which is related with it null.
         */
        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->foreign('user_category_id')
                  ->references('id')
                  ->on('user_vocabularies')
                  ->nullOnDelete();
        });

        Schema::table('user_categories', function (Blueprint $table) {
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
        Schema::table('user_vocabularies', function (Blueprint $table) {
            $table->dropForeign('user_vocabularies_user_category_id_foreign');
        });

        Schema::table('user_categories', function (Blueprint $table) {
            $table->dropForeign('user_categories_user_id_foreign');
        });
        Schema::dropIfExists('user_categories');
    }
}
