<?php

namespace Database\Seeders;

use App\Models\WordType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedTypes = [
            [
                'id' => 1,
                'code' => 'OT',
                'name' => 'Other'
            ],

            [
                'id' => 10,
                'code' => 'AC',
                'name' => 'Acronym'
            ],

            [
                'id' => 11,
                'code' => 'TE',
                'name' => 'Term'
            ],

            [
                'id' => 12,
                'code' => 'AB',
                'name' => 'Abbreviation'
            ],

            [
                'id' => 13,
                'code' => 'MN',
                'name' => 'Mnemonic'
            ],

            [
                'id' => 14,
                'code' => 'BA',
                'name' => 'Backronym'
            ],

            [
                'id' => 15,
                'code' => 'IN',
                'name' => 'Initialism'
            ],

        ];

        foreach ($seedTypes as $seedType)
        {
            WordType::updateOrCreate($seedType);
        }
    }
}
