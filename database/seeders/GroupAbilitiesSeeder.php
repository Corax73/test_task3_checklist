<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupAbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for SuperAdmin
        for ($i = 1; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'users_groups_id' => 1,
                'ability_groups_id' => $i
            ]);
        }

        //for Admin
        for ($i = 1; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'users_groups_id' => 2,
                'ability_groups_id' => $i
            ]);
        }

        //for Moderator
        for ($i = 5; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'users_groups_id' => 3,
                'ability_groups_id' => $i
            ]);
        }

        // for User
        for ($i = 7; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'users_groups_id' => 4,
                'ability_groups_id' => $i
            ]);
        }

    }
}
