<?php

namespace Database\Seeders;

use App\Models\Definition;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::findOrFail(1);

        $seedWords = [
            [
                'word' => 'IBM',
                'definition' => 'International Business Machines',
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'laser',
                'definition' => 'Light Amplification by Stimulated Emission of Radiation',
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'MoSCoW',
                'definition' => "Must Have, Should Have, Could Have, Won't Have",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'THROAT',
                'definition' => "The Huge Resource Of Acronyms and Terms",
                'word_type' => 'Backronym',
            ],

            [
                'word' => 'CRUD',
                'definition' => "Create, Retrieve, Update, Delete",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'KISS',
                'definition' => "Keep It Simple, Stupid",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'PHP',
                'definition' => "PHP Hypertext Preprocessor",
                'word_type' => 'Name',
            ],

            [
                'word' => 'imho',
                'definition' => "In My Honest Opinion",
                'word_type' => 'Textese',
            ],

            [
                'word' => 'DRY',
                'definition' => "Don't Repeat Yourself",
                'word_type' => 'Acronym',
            ],

            [
                'word' => 'inc.',
                'definition' => "Incorporated",
                'word_type' => 'Abbreviation',
            ],

            [
                'word' => 'imo',
                'definition' => "In My Opinion",
                'word_type' => 'Textese',
            ],

            [
                'word' => 'Silly Old Henry Carried a Horse To Our Abattoir',
                'definition' => "Sin = Opposite/Hypotenuse, Cosine = Adjacent/Hypotenuse, Tan = Opposite/Adjacent",
                'word_type' => 'Mnemonic',
            ],

            [
                'word' => 'SQL',
                'definition' => "Structured Query Language",
                'word_type' => 'Initialism',
            ],

            [
                'word' => 'btw',
                'definition' => "By The Way",
                'word_type' => 'Textese',
            ],

            [
                'word' => "can't",
                'definition' => "cannot",
                'word_type' => 'Contraction',
            ],

            [
                'word' => "Dr.",
                'definition' => "Doctor",
                'word_type' => 'Contraction',
            ],


        ];


//        // 创建示例用户（如果需要的话）
//        $user = User::findOrFail(1);
//
//        foreach ($seedWords as $seedWord) {
//            // 初始化 $wordType 变量
//            $wordType = null;
//
//            // 在循环内创建新用户
//            $newUser = User::factory()->create();
//
//            // 创建词汇类型逻辑...
//            $wordType = WordType::firstWhere('name', $seedWord['word_type']);
//
//            /*
//             * 如果词汇类型不在集合中，则创建新的词汇类型。
//             * 这仍然比对每个词汇类型进行单独的 SQL 查询要快得多。
//             */
//            if (is_null($wordType)) {
//                $wordType = WordType::create([
//                    'code' => Str::upper(Str::substr(str_shuffle($seedWord['word_type']), 0, 2)),
//                    'name' => $seedWord['word_type'],
//                ]);
//
//                $this->command->line("  Created new word type: {$wordType->code} {$wordType->name}", 'comment');
//            }
//
//            // 创建单词
//            $newWord = [
//                'word' => $seedWord['word'],
//                'word_type_id' => $wordType->id,
//                'user_id' => $newUser->id, // 使用新创建的用户的ID
//            ];
//
//            $word = Word::firstWhere('word', $seedWord['word']);
//            if (is_null($word)) {
//                $word = Word::create($newWord);
//            }
//
//            // 创建定义
//            $seedDefinition = [
//                'definition' => $seedWord['definition'],
//                'user_id' => $newUser->id, // 使用新创建的用户的ID
//            ];
//
//            $definition = Definition::create($seedDefinition);
//            $word->definitions()->save($definition);
//        }

        /*
         * Grab the word types table as a collection.
         * This reduces the number of database calls made.
         */
        $wordTypes = WordType::all();

        /*
         * Loop through each word in the seed list:
         */
        foreach ($seedWords as $seedWord) {
            $wordType = $wordTypes->firstWhere('name', $seedWord['word_type']);

            /*
             * If the word type is not in the collection then we create the new word type
             * with a random code made from the word type's name (currently not checking
             * for duplicate codes/names), and retrieving the new collection of word types.
             *
             * This is still much faster than if we had individual SQL executions for each
             * word type check.
             */
            if (is_null($wordType)) {
                $wordType = WordType::create([
                    'code' => Str::upper(Str::substr(str_shuffle($seedWord['word_type']), 0, 2)),
                    'name' => $seedWord['word_type'],
                ]);

                $this->command->line("  Created new word type: {$wordType->code} {$wordType->name}", 'comment');
                $wordTypes = WordType::all();
            }

            // Create the word if it does not exist
            $newWord = [
                'word' => $seedWord['word'],
                'word_type_id' => $wordType->id,
                'user_id' => $user->id,
            ];

            $word = Word::firstWhere('word', $seedWord['word']);
            if (is_null($word)) {
                $word = Word::create($newWord);
            }

            $seedDefinition = [
                'definition' => $seedWord['definition'],
                'user_id' => $user->id,
            ];

            $definition = Definition::create($seedDefinition);
            $word->definitions()->save($definition);

        }
    }

}
