<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assign('administrator');

        $user = User::create([
            'name' => 'User Manager',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assign('user-manager');

        $user = User::create([
            'name' => 'Shop Manager',
            'email' => 'shop@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assign('shop-manager');        
    }
}
