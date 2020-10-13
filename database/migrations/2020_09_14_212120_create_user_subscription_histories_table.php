<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('renewable')->default(0);
            $table->boolean('enabled')->default(0);
            $table->float('package_price')->default(0);
            $table->float('final_price')->default(0);
            $table->string('utm_source', 100)->nullable();
            $table->string('utm_medium', 100)->nullable();
            $table->string('utm_campaign', 100)->nullable();
            $table->timestamps();
        });

        Schema::table('user_subscription_histories', function (Blueprint $table) {
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
        Schema::table('user_subscription_histories', function (Blueprint $table) {
            $table->dropForeign('user_subscription_histories_user_id_foreign');
        });

        Schema::dropIfExists('user_subscription_histories');
    }
}
