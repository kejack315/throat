<?php

namespace Database\Seeders;

use App\Models\Definition;
use App\Models\DefinitionRating;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinitionRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        $this->command->line("  - DefinitionRating", 'info');
//        $definitions = Definition::all();
//
//        foreach ($definitions as $definition) {
//            $user = User::factory()->create(); // 创建一个示例用户
//            $rating = Rating::factory()->create();
//
//            $definitionRating = DefinitionRating::create([
//                'definition_id' => $definition->id,
//                'user_id' => $user->id,
//                'rating_id' => $rating->id,
//            ]);
//        }
    }
}
