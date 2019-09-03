<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('administrator')->to(['users_manage','customers','products', 'orders']);
        Bouncer::allow('user-manager')->to('customers');
        Bouncer::allow('shop-manager')->to(['products', 'orders']);
    }
}
