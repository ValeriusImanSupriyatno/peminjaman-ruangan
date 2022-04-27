<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin@admin.com',
            'password' => Hash::make('localhost'),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'username' => 'user@user.com',
            'password' => Hash::make('localhost'),
            'role' => 'user',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'Administrator1',
            'username' => 'admin1@admin1.com',
            'password' => Hash::make('localhost'),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'User1',
            'username' => 'user1@user1.com',
            'password' => Hash::make('localhost'),
            'role' => 'user',
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
