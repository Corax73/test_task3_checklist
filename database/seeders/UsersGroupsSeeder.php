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
        DB::table('usersgroups') -> insert([
            'name' => 'SuperAdmin'
            ]);
        DB::table('usersgroups') -> insert([
           'name' => 'Admin'
            ]);
        DB::table('usersgroups') -> insert([
            'name' => 'Moderator'
            ]);
        DB::table('usersgroups') -> insert([
            'name' => 'User'
            ]);
    }
}
