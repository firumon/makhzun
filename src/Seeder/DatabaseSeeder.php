<?php

namespace Firumon\Makhzun\Seeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             CountrySeeder::class,
             StateSeeder::class,
             CitySeeder::class,
             CodeSeeder::class,
             OptionSeeder::class,
             HeaderSeeder::class,
             SettingsSeeder::class,
             GroupSeeder::class,
             ApiSeeder::class,
             FormSeeder::class,
         ]);
    }
}
