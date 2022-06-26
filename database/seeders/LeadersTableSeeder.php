<?php

namespace Database\Seeders;

use App\Models\Leader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LeadersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*  DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Leader::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); */

        $faker = \Faker\Factory::create();

        $password = Hash::make('grads');

        for ($i = 1; $i <= 5; $i++) {
            Leader::create([
                'username' => $faker->text(10),
                'name' => $faker->text(10),
                'password' => $password
            ]);
        }
    }
}
