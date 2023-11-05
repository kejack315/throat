<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Definition;
use App\Http\Requests\StoreDefinitionRequest;
use App\Http\Requests\UpdateDefinitionRequest;
use App\Models\DefinitionRating;
use App\Models\Rating;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class DefinitionController extends Controller
{
    function __construct()

    {
        $this->middleware('permission:definition_browse', ['only' => ['show']]);
        $this->middleware('permission:definition_create', ['only' => ['create','store']]);
        $this->middleware('permission:definition_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:definition_delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        $definitions = Word::with('wordType', 'definitions')->latest()->paginate(10);
//        return view('definitions.index', compact('definitions'));
//    }

    public function index()
    {
        $definitions = Definition::with('word','wordType', 'user')->latest()->paginate(5);
        return view('definitions.index', compact('definitions'));
    }

    public function create()
    {
        $wordTypes = WordType::pluck('name', 'name'); // 获取所有 word 类型
        return view('definitions.create', compact('wordTypes'));
    }

//    public function show(Definition $definition)
//    {
//        // 获取当前定义的所有子定义
//        $subDefinitions = $definition->definitions;
//
//        return view('definitions.show', compact('definition', 'subDefinitions'));
//    }

    public function show(Definition $definition)
    {
        // 获取与当前定义相关的所有评级
        $ratings = Rating::whereHas('definitions', function ($query) use ($definition) {
            $query->where('definition', $definition->definition);
        })->get();

        // 只加载 word 列的数据
        $word = $definition->word;

        return view('definitions.show', compact('definition', 'word', 'ratings'));
    }
    public function add(Definition $definition)
    {
        $definitions = Definition::all(); // 添加此行以定义 $definitions 变量
        $wordTypes = WordType::all();
        $ratings = Rating::all();

        // 传递表单请求数据到视图，包括 'definition' 字段
        return view('definitions.add', compact('definition', 'definitions', 'wordTypes', 'ratings'));
    }


    public function edit(Definition $definition)
    {


        if ($definition->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $definitions = Definition::all();
        $wordTypes = WordType::all();
        $ratings = Rating::all();
        return view('definitions.edit', compact('definition', 'definitions', 'wordTypes','ratings'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete(Definition $definition)
    {
        if ($definition->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $word = $definition->word;
        $definition = $word->definitions->first();
        $wordType = $word->wordType;

        return view('definitions.delete', compact('definition', 'word', 'wordType'));
    }

//    public function store(StoreWordRequest $request)
//    {
//        $details = $request->validated();
//        $word = Word::create($details);
//        return redirect(route('users.index'))
//            ->with('created', $word->name)
//            ->with('messages', true);
//    }

    public function store(StoreDefinitionRequest $request)
    {

        $user = auth()->user();
        $seedDefinition = $request->only(['user','word', 'definition', 'word_type','stars']);
        // 检查用户是否已登录，如果未登录则将 $user 设置为默认用户（ID为1）
        if (!$user) {
            $user = User::find(1); // 使用适当的方法查找默认用户，这里假设默认用户的模型是 User
        }
        $definition = Definition::firstOrcreate([
            'definition' => $seedDefinition['definition'],
            'user_id' => $user->id, // 使用当前用户或默认用户的ID
        ]);

        $rating = Rating::firstOrCreate(['stars' => $seedDefinition['stars']]);
        $definition->ratings()->attach($rating, ['stars' => $seedDefinition['stars']]);
        $wordType = WordType::firstOrCreate(
            ['name' => $seedDefinition['word_type']]
        );
        $word = Word::firstOrCreate(
            ['word' => $seedDefinition['word']],
            [
                'word_type_id' => $wordType->id,
                'user_id' => $user->id, // 使用当前用户或默认用户的ID
            ]
        );

//        $wordType = WordType::firstWhere('name', $seedDefinition['word_type']);
//
//        if (is_null($wordType)) {
//            $wordType = WordType::create([
//                'code' => Str::upper(Str::substr(str_shuffle($seedDefinition['word_type']), 0, 2)),
//                'name' => $seedDefinition['word_type'],
//            ]);
//        }

//        $word = Word::firstWhere('word', $seedDefinition['word']);
//
//        if (is_null($word)) {
//            $word = Word::create([
//                'word' => $seedDefinition['word'],
//                'word_type_id' => $wordType->id,
//                'user_id' => $user->id, // 使用当前用户或默认用户的ID
//            ]);
//        }

        $word->definitions()->save($definition);
        // 可以添加成功后的重定向或其他逻辑
        return redirect()->route('definitions.index')->with('success', '单词已成功创建。');
    }




    /**
     * Update the specified resource in storage.
     */


    public function update(UpdateDefinitionRequest $request, Definition $definition)
    {
        $seedDefinition = $request->only(['word', 'definition', 'word_type', 'stars']);
        if ($definition->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // 更新Definition模型
        $definition->update([
            'word' => $seedDefinition['word'],
            'definition' => $seedDefinition['definition'],
            'word_type' => $seedDefinition['word_type'],
            // 其他需要更新的字段
        ]);

        // 更新或创建相关的WordType
        $wordType = WordType::firstWhere('name', $seedDefinition['word_type']);
        //更新当前rating
        $rating = Rating::where('stars', $seedDefinition['stars'])->first();

        if (is_null($rating)) {
            $rating = Rating::create([
                'stars' => $seedDefinition['stars'],
            ]);
        }
        $definition->ratings()->sync([$rating->id => ['stars' => $seedDefinition['stars']]]);
        //可添加多个rating
//        $rating = Rating::firstOrCreate(['stars' => $seedDefinition['stars']]);
//                if (is_null($rating)) {
//            $rating = Rating::create([
//                'stars' => $seedDefinition['stars'],
//            ]);
//        }
//        $definition->ratings()->attach($rating, ['stars' => $seedDefinition['stars']]);

//         更新Word模型的word_type_id
        $definition->word->update(['word_type_id' => $wordType->id]);
//
        return redirect(route('definitions.index'))
            ->with('updated', "{$definition->word}")
            ->with('messageType', 'updated');
    }


    public function destroy(Definition $definition, Request $request)
    {
        $loggedInUser = $request->user(); // 获取当前登录的用户

        // 如果当前登录的用户不是条目的创建者，并且也不是管理员
        if ($loggedInUser->id !== $definition->user_id && !$loggedInUser->hasRole('admin')) {
            return redirect(route('definitions.index'))->with('error', 'You are not allowed to delete this definition.');
        }

        $oldDefinition = $definition->definition; // 将要显示的删除信息存储到变量中
        $definition->delete();
        return redirect(route('definitions.index'))->with('deleted', "{$oldDefinition}");
    }

}
