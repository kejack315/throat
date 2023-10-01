<?php

namespace Database\Seeders;

use App\Models\Definition;
use App\Models\DefinitionRating;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->line("  - Definitions seeded by the Word seeder", 'info');

    }
}
