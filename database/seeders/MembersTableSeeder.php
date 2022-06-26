<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Team;
use Dotenv\Util\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str as SupportStr;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            Member::create([
                'team_id' => $faker->randomElement(Team::pluck('id')),
                'name' => $faker->name(),
                'department' => strtoupper(SupportStr::random(rand(2, 3))),
                'major' => $faker->text(10)
            ]);
        }
    }
}
