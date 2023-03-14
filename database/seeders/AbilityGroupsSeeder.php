<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilityGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ability_groups') -> insert([
            'name' => 'Create checklist'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Delete checklist'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Create item'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Delete item'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Implementation true'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Implementation false'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Get all checklists'
            ]);
        DB::table('ability_groups') -> insert([
            'name' => 'Get checklist items'
            ]);
    }
}
