<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = array('name' => 'John Munoz','email' => 'sistemas@arioscolombia.com.co','password' => bcrypt('arios.123'),);
    	$role_user = array('role_id' => 1,'user_id' => 1,);

    	DB::table('users')->insert($admin);
    	DB::table('role_user')->insert($role_user);
    }
}
