<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetupDejavuAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dejavu-admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates Dejavu administrators.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Setting up Dejavu admin users.');
        $this->createMaster();
        $this->createCustomer();
        $this->info('All done!');
        return 0;
    }

    private function createMaster()
    {
        $user = User::find(1);
        if (empty($user)) {
            $new_user = new User();
            $new_user->name = 'Dejavu';
            $new_user->family_name = 'English';
            $new_user->email = 'burhanmt@outlook.com';
            $new_user->password = bcrypt('Efsane46');
            $new_user->role = 6; // Master
            $new_user->dejavu_client_id = 1; // Dejavu Customer
            if ($new_user->save()) {
                $this->info('The master user has been created.');
            } else {
                $this->info('Something went wrong! The master user hasn\'t been created.');
            }
        }
    }

    private function createCustomer()
    {
        $user = User::find(2);
        if (empty($user)) {
            $new_user                   = new User();
            $new_user->name             = 'Dejavu Test';
            $new_user->family_name      = 'English';
            $new_user->email            = 'burhanmt@icloud.com';
            $new_user->password         = bcrypt('12345678');
            $new_user->role             = 0; // Customer
            $new_user->dejavu_client_id = 1; // Dejavu Customer

            if ($new_user->save()) {
                $this->info('The test user has been created.');
            } else {
                $this->info('Something went wrong! The test user hasn\'t been created.');
            }
        }
    }
}
