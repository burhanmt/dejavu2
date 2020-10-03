<?php

use App\Models\DejavuClient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDejavuUsersDataToDejavuClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  Add 'Dejavu Users' as client. All standalone users will be under this client.
         *  Never delete it. It must be always in this table.
         */
        $new_client = new DejavuClient();
        $new_client->client_name = 'Dejavu Users';
        $new_client->enabled = true;
        $new_client->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the records
        DB::table('dejavu_clients')
            ->where('id', 1)
            ->delete();

        // Reset the auto_increment value
        DB::update('ALTER TABLE interest_translations AUTO_INCREMENT = 1');
    }
}
