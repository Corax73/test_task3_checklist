<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users') -> where('name', 'test') -> update(['usersgroup_id' => 1]);
        
        for ($i = 2; $i <= 4; $i++) {
            DB::table('users') -> where('name', 'test' . ($i - 1)) -> update(['usersgroup_id' => $i]);
        }
    }
}
