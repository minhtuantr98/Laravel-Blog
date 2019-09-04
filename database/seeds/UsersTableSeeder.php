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
        DB::table('users')->insert([
            ['name'=>'minhtuan', 'email' => "tuan@123.com", 'password'=>Hash::make("abcd1234")],
            ['name'=>'cuonggiang', 'email' => "cuong@123.com", 'password'=>Hash::make("12345678")]
        ]);
    }
}
