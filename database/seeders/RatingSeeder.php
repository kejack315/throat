<?php

namespace Database\Seeders;

use App\Models\DefinitionRating;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedRatings = [
            ['id' => 01, 'name' => 'Unrated', 'stars' => 0, 'icon' => 'lemon'],
            ['id' => 10, 'name' => 'Terrible', 'stars' => 1, 'icon' => 'lemon'],
            ['id' => 30, 'name' => 'Poor', 'stars' => 1, 'icon' => 'star'],
            ['id' => 40, 'name' => 'Ok', 'stars' => 2, 'icon' => 'star'],
            ['id' => 50, 'name' => 'Average', 'stars' => 3, 'icon' => 'star'],
            ['id' => 70, 'name' => 'Great', 'stars' => 4, 'icon' => 'star'],
            ['id' => 90, 'name' => 'Amazing', 'stars' => 5, 'icon' => 'star'],
        ];

        foreach ($seedRatings as $seedRating) {
            Rating::updateOrCreate($seedRating);
        }

//        foreach ($seedRatings as $seedRating) {
//            $rating = Rating::updateOrCreate($seedRating);
//
//            $seedDefinitionRating = [
//                'rating_id' => $rating->id,
//                'value' => $rating->stars,
//            ];
//
//            $definitionRating = DefinitionRating::create($seedDefinitionRating);
//
//            // 删除以下代码块
//            // 创建 Rating 记录时不设置 name 列的值
//            // $rating = Rating::create(['stars' => $starsValue]);
//
//            // 将 definitionRating 与 rating 关联
//            $rating->definitionRating()->save($definitionRating);
//        }


    }
}
