<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Definition;
use App\Models\DefinitionRating;
use App\Models\DefinitionRatings;
use App\Models\Rating;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DefinitionRatingController extends Controller
{
    /**
     * Get a task
     *
     * @param Request $request

     * @return \Illuminate\Http\JsonResponse
     */
    function __construct()
    {
        $this->middleware('permission:definition_browse', ['only' => ['show']]);
        $this->middleware('permission:definition_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:definition_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:definition_delete', ['only' => ['destroy']]);

    }
    public function get(Request $request, Definition $definition): \Illuminate\Http\JsonResponse
    {
        // 获取当前登录的用户ID
        $userId = $request->user()->id;

        // 根据传入的Definition对象和用户ID查询相关的DefinitionRating
        $definitionRating = DefinitionRating::with('definition')
            ->where('user_id', $userId)
            ->where('definition_id', $definition->id)
            ->first();

        if (!$definitionRating) {
            return response()->json(['message' => 'No DefinitionRating found for the user.'], 404);
        }

        return response()->json($definitionRating);
    }






    /**
     * Get all tasks
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function index(Request $request): \Illuminate\Http\JsonResponse
//    {
//        // 加载与每个DefinitionRating相关的Definition和Rating数据
//        $definitionRatings = DefinitionRating::with(['definition', 'rating'])->get();
//        return response()->json($definitionRatings);
//    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        // 加载与每个DefinitionRating相关的Definition和Rating数据
        $definitionRatings = DefinitionRating::with(['definition', 'rating'])->get();
        return response()->json($definitionRatings);
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
//        $ratingValue = $request->input('rating');
//
//        // 可能需要额外的验证和授权检查
//        $rating = new Rating(['rating_value' => $ratingValue]);
//        $rating->save();
//        // 获取请求数据
//        $data = $request->all();
//
//        // 创建记录
//        $definitionRating = DefinitionRating::create($data);
//
//        return response()->json($definitionRating, 201);
//    }
    public function store(Request $request, Definition $definition) {
        $stars = $request->input('stars');
        $definitionId = $request->input('definition_id');
        $definition = Definition::findOrFail($definitionId);

        // 查找给定星级的Rating，如果不存在则创建
        $rating = Rating::firstOrCreate(['stars' => $stars]);

        // 检查是否已经有了这个关联
        if (!$definition->ratings()->where('ratings.id', $rating->id)->exists()) {
            // 添加user_id到关联数据中
            $definition->ratings()->attach($rating->id, ['stars' => $stars, 'user_id' => $request->user()->id]);
        } else {
            // 如果关联已经存在，只更新stars的值
            $definition->ratings()->updateExistingPivot($rating->id, ['stars' => $stars]);
        }

        return response()->json([
            'message' => 'Rating added or updated successfully',
            'definition' => $definition->definition,  // 假设Definition模型中有一个名为'definition'的属性或字段
            'stars' => $rating->stars,
        ]);
    }







    /**
     * Update the task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Definition $definition) {
        $validatedData = $request->validate([
            'stars' => 'required|integer|min:1|max:10',
        ]);

        $stars = $validatedData['stars'];

        // 查找给定星级的Rating，如果不存在则创建
        $rating = Rating::firstOrCreate(['stars' => $stars]);

        // 检查是否已经有了这个关联
        if (!$definition->ratings()->where('ratings.id', $rating->id)->exists()) {
            $definition->ratings()->attach($rating->id, ['stars' => $stars]);
        } else {
            // 如果关联已经存在，只更新stars的值
            $definition->ratings()->updateExistingPivot($rating->id, ['stars' => $stars]);
        }

        return response()->json([
            'message' => 'Rating updated successfully',
            'definition' => $definition->definition,  // 假设Definition模型中有一个名为'definition'的属性或字段
            'stars' => $rating->stars,
        ]);
    }




    /**
     * Remove task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Definition $definition) {
        // 获取当前用户为此定义评的分数
//        $definitionRating = $definition->ratings()->where('user_id', auth()->id())->first();

//        if (!$definitionRating) {
//            return response()->json(['message' => 'Rating not found'], 404);
//        }

        // 保存星级供后面使用
//        $stars = $definitionRating->rating->stars;
//
//        // 删除这个评分，但不删除整个Rating
//        $definition->ratings()->detach($definitionRating->rating_id);
//
//        return response()->json([
//            'message' => 'Rating deleted successfully',
//            'definition' => $definition->definition,  // 假设Definition模型中有一个名为'definition'的属性或字段
//            'stars' => $stars,



// 获取与此definition关联的stars值（可能有多个，但我们只获取第一个）
        $stars = $definition->ratings()->first()->stars ?? null;

        // 删除与此definition关联的所有ratings
        $definition->ratings()->detach();

        return response()->json([
            'message' => 'Rating deleted successfully',
            'definition' => $definition->definition,
            'stars' => $stars,  // 这将返回之前关联的stars值，或者如果没有则返回null

        ]);
    }



    /**
     * Complete the task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function complete(Request $request, DefinitionRatings $definitionRating): \Illuminate\Http\JsonResponse
    {
        try {
            $definitionRating->completed = true;
            if ($definitionRating->saveOrFail()) {
                return response()->json(null, 204);
            }
        } catch (Exception $e) {
            Log::debug('error completing task.', ['id' => $definitionRating->id]);
        }

        return response()->json('error_completing', 400);
    }
}
