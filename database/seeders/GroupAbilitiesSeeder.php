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
                'usersgroup_id' => 1,
                'abilitygroup_id' => $i
            ]);
        }

        //for Admin
        for ($i = 1; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'usersgroup_id' => 2,
                'abilitygroup_id' => $i
            ]);
        }

        //for Moderator
        for ($i = 5; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'usersgroup_id' => 3,
                'abilitygroup_id' => $i
            ]);
        }

        // for User
        for ($i = 7; $i <= 8; $i++) {
            DB::table('group_abilities') -> insert([
                'usersgroup_id' => 4,
                'abilitygroup_id' => $i
            ]);
        }

    }
}
