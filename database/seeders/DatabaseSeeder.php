<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Definition;
use App\Models\DefinitionRatings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Users::factory(10)->create();

        // \App\Models\Users::factory()->create([
        //     'name' => 'Test Users',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            RatingSeeder::class,
            WordTypeSeeder::class,
            WordSeeder::class,
            DefinitionSeeder::class,
            DefinitionRatingSeeder::class,
            CreateAdminUserSeeder::class,
            PermissionTableSeeder::class,
        ]);
    }
}
