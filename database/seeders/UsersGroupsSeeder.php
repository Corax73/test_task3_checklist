<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_groups') -> insert([
            'name' => 'SuperAdmin'
            ]);
        DB::table('users_groups') -> insert([
           'name' => 'Admin'
            ]);
        DB::table('users_groups') -> insert([
            'name' => 'Moderator'
            ]);
        DB::table('users_groups') -> insert([
            'name' => 'User'
            ]);
    }
}
