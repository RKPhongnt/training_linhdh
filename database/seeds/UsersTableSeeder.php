<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<6; $i++)
        {
        	DB::table('users')->insert([
            	'name' => 'User_'.$i,
            	'email' => 'user_'.$i.'@gmail.com',
            	'password' => bcrypt(123456),
        	]);
        }
    }
}
