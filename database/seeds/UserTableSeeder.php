<?php

/**
 * Created by PhpStorm.
 * User: ACer
 * Date: 12/13/2016
 * Time: 1:18 PM
 */

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('siteusers')->delete();

        $users = array(
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@gmail.com', 'role' => 'admin', 'password' => 'password', 'remember_token' => ""]
        );

        DB::table('siteusers')->insert($users);
    }
}