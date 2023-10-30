<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    /**
     * Get a task
     *
     * @param Request $request

     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {


        // 如果没有'search'查询参数，返回指定的单词和它的定义
        return response()->json($word->load('definitions'));
    }

    public function search(Request $request, Word $word):\Illuminate\Http\JsonResponse
    {
        // 如果有'search'查询参数
            $search = $request->input('query');
            // 使用like查询进行模糊查询
            $words = Word::where('word', 'like', "%{$search}%")
                ->with('definitions') // 预加载定义
                ->get();
            return response()->json($words);
    }


    /**
     * Get all tasks
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
     * Add task
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
     * Update the task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Word $word): \Illuminate\Http\JsonResponse
    {
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
//            if($request->has('code')){
//                $wordType->code = $request->get('code');
//            }


            if ($word->updateOrFail()) {
                return response()->json($word);
            }

        } catch (Exception $e) {
            Log::debug('error updating task', ['id' => $word->id]);
        }

        return response()->json('error_updating', 400);
    }

    /**
     * Remove task
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
     * Complete the task
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
