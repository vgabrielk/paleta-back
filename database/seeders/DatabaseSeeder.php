<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Buscar os portfolios com data nula
        $portfolios = Portfolio::whereNull('data')->get();

        foreach ($portfolios as $portfolio) {
            $portfolio->data = [
                'name' => $faker->word,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'avatar' => $faker->imageUrl(640, 480, 'people', true),
                'links' => [
                    [
                        'label' => $faker->word,
                        'url' => $faker->url,
                    ]
                ],
                'experiences' => [
                    [
                        'role' => $faker->jobTitle,
                        'company' => $faker->company,
                        'period' => $faker->date(),
                        'description' => $faker->sentence,
                    ]
                ],
                'education' => [
                    [
                        'course' => $faker->word,
                        'institution' => $faker->company,
                        'period' => $faker->year,
                    ]
                ]
            ];

            $portfolio->save();
        }
    }
}
