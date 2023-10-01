<?php

namespace App\Http\Controllers;


use App\Models\Definition;
use App\Models\User;
use App\Models\Word;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\WordType;
use Illuminate\Support\Str;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        $words = Word::with('definitions.wordType')->latest()->paginate(10);
//        return view('words.index', compact('words'));
//    }
    public function index()
{
    $words = Word::query()->latest()->paginate(10);
    return view('words.index',compact('words'));
}



    public function create()
    {
        $wordTypes = WordType::pluck('name', 'name'); // Fetch all word types as key-value pairs
        return view('words.create', compact('wordTypes'));
    }

    public function show(Word $word)
    {
        $word->load('definitions.wordType');
        return view('words.show', compact('word'));
    }

    public function edit(Word $word)
    {
        $definitions = Definition::all();
        $wordTypes = WordType::all();

        return view('words.edit', compact('word', 'definitions', 'wordTypes'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete(Word $word)
    {
        $definition = $word->definitions->first();
        $wordType = $word->wordType;

        return view('words.delete', compact('word', 'definition', 'wordType'));
    }

//    public function store(StoreWordRequest $request)
//    {
//        $details = $request->validated();
//        $word = Word::create($details);
//        return redirect(route('users.index'))
//            ->with('created', $word->name)
//            ->with('messages', true);
//    }

    public function store(StoreWordRequest $request)
    {
        $user = auth()->user();
        $seedWord = $request->only(['word', 'definition', 'word_type']);

        // 检查用户是否已登录，如果未登录则将 $user 设置为默认用户（ID为1）
        if (!$user) {
            $user = User::find(1); // 使用适当的方法查找默认用户，这里假设默认用户的模型是 User
        }

        $definition = Definition::create([
            'definition' => $seedWord['definition'],
            'user_id' => $user->id, // 使用当前用户或默认用户的ID
        ]);

        $wordType = WordType::firstWhere('name', $seedWord['word_type']);

        if (is_null($wordType)) {
            $wordType = WordType::create([
                'code' => Str::upper(Str::substr(str_shuffle($seedWord['word_type']), 0, 2)),
                'name' => $seedWord['word_type'],
            ]);
        }

        $word = Word::firstWhere('word', $seedWord['word']);

        if (is_null($word)) {
            $word = Word::create([
                'word' => $seedWord['word'],
                'word_type_id' => $wordType->id,
                'user_id' => $user->id, // 使用当前用户或默认用户的ID
            ]);
        }

        $word->definitions()->save($definition);

        // 可以添加成功后的重定向或其他逻辑

        return redirect()->route('words.index')->with('success', '单词已成功创建。');
    }


// 如果需要设置user id的情况下：
//    public function store(StoreWordRequest $request)
//    {
//        $user = auth()->user();
//        $seedWord = $request->only(['word', 'definition', 'word_type']);
//
//        // Check if the user is authenticated
//        if ($user) {
//            $definition = Definition::create([
//                'definition' => $seedWord['definition'],
//                'user_id' => $user->id,
//            ]);
//
//            $wordType = WordType::firstWhere('name', $seedWord['word_type']);
//
//            if (is_null($wordType)) {
//                $wordType = WordType::create([
//                    'code' => Str::upper(Str::substr(str_shuffle($seedWord['word_type']), 0, 2)),
//                    'name' => $seedWord['word_type'],
//                ]);
//            }
//
//            $word = Word::firstWhere('word', $seedWord['word']);
//
//            if (is_null($word)) {
//                $word = Word::create([
//                    'word' => $seedWord['word'],
//                    'word_type_id' => $wordType->id,
//                    'user_id' => $user->id,
//                ]);
//            }
//
//            $word->definitions()->save($definition);
//
//            // 可以添加成功后的重定向或其他逻辑
//
//            return redirect()->route('words.index')->with('success', '单词已成功创建。');
//        } else {
//            // Handle the case when the user is not authenticated
//            // You can redirect or show an error message as needed
//            return redirect()->route('login')->with('error', '请登录后创建单词。');
//        }
//    }


    /**
     * Update the specified resource in storage.
     */


        // 更新Word模型
    public function update(UpdateWordRequest $request, Word $word)
    {
        $validated = $request->validated();

        $word->update([
            'word' => $validated['word'],
//            'word_type_id' => $validated['word_type_id'],
            // 其他需要更新的字段
        ]);

        // 更新相关的Definition
        foreach ($word->definitions as $definition) {
            $definition->update([
                'definition' => $validated['definition'],
                // 其他需要更新的字段
            ]);
        }

        // 更新或创建相关的WordType
        $wordType = WordType::firstWhere('name', $validated['word_type']);
        if (is_null($wordType)) {
            $wordType = WordType::create([
                'code' => Str::upper(Str::substr(str_shuffle($validated['word_type']), 0, 2)),
                'name' => $validated['word_type'],
            ]);
        }

        // 更新Word模型的word_type_id
        $word->update(['word_type_id' => $wordType->id]);

        return redirect(route('words.index'))
            ->with('updated', "{$word->word}")
            ->with('messageType', 'updated');
    }



    public function destroy(Word $word)
    {
        $oldWord = $word;
        $word->delete();
        return redirect(route('words.index'))->with('deleted', "{$oldWord->word}");
    }
}
