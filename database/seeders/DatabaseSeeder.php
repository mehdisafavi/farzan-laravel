<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'safavi',
             'email' => 'msafavy@gmail.com',
             'password' => '$2y$10$tNygSqBDYrysCOkxNTNN9uwiZKHKgoaxQMjvl7YzrYXfAWAA2jj3O'
         ]);

         \App\Models\BikeColor::factory()->create([
             'name' => 'سبز'
         ]);
         \App\Models\BikeColor::factory()->create([
             'name' => 'سفید'
         ]);

         \App\Models\BikeColor::factory()->create([
             'name' => 'سرخ'
         ]);

         \App\Models\BikeModel::factory()->create([
             'name' => '2018'
         ]);
         \App\Models\BikeModel::factory()->create([
             'name' => '2019'
         ]);
         \App\Models\BikeModel::factory()->create([
             'name' => '2020'
         ]);

    }
}
