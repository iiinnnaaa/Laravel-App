<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'user_id' => rand(1,11),
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'user_id' => rand(1,11),
        ]);
        DB::table('roles')->insert([
            'name' => 'moderator',
            'user_id' => rand(1,11),
        ]);
        DB::table('roles')->insert([
            'name' => 'editor',
            'user_id' => rand(1,11),
        ]);
        DB::table('roles')->insert([
            'name' => 'client',
            'user_id' => rand(1,11),
        ]);
    }
}
