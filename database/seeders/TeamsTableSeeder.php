<?php

namespace Database\Seeders;

use App\Models\Leader;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Team::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); */

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            Team::create([
                'leader_id' => $faker->randomElement(Leader::pluck('username')->all()),
                'needs' => $faker->text(30)
            ]);
        }
    }
}
