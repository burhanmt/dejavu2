<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('dejavu_client_id')->nullable();
        });

        /**
         * if the admin delete  the client form the table,
         * the system will make the dejavu_client_id value which is related with it null.
         */
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('dejavu_client_id')
                ->references('id')
                ->on('dejavu_clients')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_dejavu_client_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dejavu_client_id');
        });
    }
}
