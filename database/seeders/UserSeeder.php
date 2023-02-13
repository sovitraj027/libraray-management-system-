<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@123'),
                'user_type_id' => 1
            ],

            [
                'name' => 'Librarian One',
                'email' => 'lib1@mail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 2
            ],

            [
                'name' => 'Librarian Two',
                'email' => 'lib2@mail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 2
            ],
            [
                'name' => 'Member',
                'email' => 'member@mail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 3
            ],
        ];

        DB::table('users')->insert($users);
    }
}
