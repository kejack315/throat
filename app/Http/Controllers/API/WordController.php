<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group Word API
 *
 * This API is for Word CRUD
 */
class WordController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:word_browse', ['only' => ['show']]);
        $this->middleware('permission:word_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:word_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:word_delete', ['only' => ['destroy']]);

    }
    /**
     * Get A Word
     *
     * @param Request $request

     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {
        // 如果没有'search'查询参数，返回指定的单词和它的定义
        return response()->json($word->load('definitions'));
    }

    /**
     * Search a word by using word.
     *
     * This endpoint allows you to find a word in the list.
     * It's a really useful endpoint, and you should play around
     * with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */

    public function search(Request $request):\Illuminate\Http\JsonResponse
    {
            $search = $request->input('query');
//dd($search);
            $words = Word::where('word', 'like', "%{$search}%")
                ->with('definitions')
                ->get();
            return response()->json($words);
    }


    /**
     * Get all words, 10 per page
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        // 获取请求中的 perPage 参数，如果不存在则使用默认值 10
        $perPage = $request->input('perPage', 10);

        $words = Word::paginate($perPage);

        return response()->json($words);
    }


    /**
     * Add a word
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
//    public function add(Request $request)
//    {
//        $validator = Validator::make($request->post(), [
//            'word' => 'required',
//        ]);
//
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 400);
//        }
//
//        try {
//            $word = new Word();
//            $word->word = $request->get('word');
//
//            if ($word->saveOrFail()) {
//                return response()->json($word);
//            }
//
//        } catch (Exception $e) {
//            Log::debug('error creating task');
//        }
//
//        return response()->json('error_creating', 400);
//    }
    /**
     * Add a word to the list.
     *
     * This endpoint allows you to add a word to the list.
     * It's a really useful endpoint, and you should play around
     * with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */
    public function add(Request $request)
    {
        // 获取请求数据
        $data = $request->all();

        // 检查是否提供了 word_type_id
        if (!isset($data['word_type_id'])) {
            // 如果没有提供，则设置默认值
            $data['word_type_id'] = 1;
            $data['user_id'] = 1;// 或其他你想要的默认值
        }

        // 创建记录
        $word = Word::create($data);

        return response()->json($word, 201);
    }


    /**
     * Update a word
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {

        $loggedInUser = $request->user();
        $wordUser = User::find($word->user_id); // 获取word的创建者

        if ($wordUser && $wordUser->hasRole('admin')) {
            if (!$loggedInUser->hasRole('admin')) {
                return response()->json(['message' => 'You are not allowed to update words of admin.'], 403);
            }
        }

        $validator = Validator::make($request->post(), [
            'word' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            if($request->has('word')){
                $word->word = $request->get('word');
            }

            if ($word->updateOrFail()) {
                return response()->json($word);
            }

        } catch (Exception $e) {
            Log::debug('error updating task', ['id' => $word->id]);
        }

        return response()->json('error_updating', 400);
    }

    /**
     * Remove a word
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {
        if ($word->delete()) {
            return response()->json(['message' => 'delete success'], 200);
        }

        return response()->json(['message' => 'error_removing'], 400);
    }

    /**
     * Complete the word
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function complete(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {
        try {
            $word->completed = true;
            if ($word->saveOrFail()) {
                return response()->json(null, 204);
            }
        } catch (Exception $e) {
            Log::debug('error completing task.', ['id' => $word->id]);
        }

        return response()->json('error_completing', 400);
    }
}
