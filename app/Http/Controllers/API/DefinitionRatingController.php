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

    function __construct()
    {
        $this->middleware('permission:definition_browse', ['only' => ['show']]);
        $this->middleware('permission:definition_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:definition_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:definition_delete', ['only' => ['destroy']]);

    }
    /**
     * Get a Definition.
     *
     * This endpoint allows you to get a definition.
     * It's a really useful endpoint, and you should play around
     * with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */
    public function get(Request $request, Definition $definition): \Illuminate\Http\JsonResponse
    {

        $userId = $request->user()->id;

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
     * Get all definition_ratings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function index(Request $request): \Illuminate\Http\JsonResponse
//    {

//        $definitionRatings = DefinitionRating::with(['definition', 'rating'])->get();
//        return response()->json($definitionRatings);
//    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

        $definitionRatings = DefinitionRating::with(['definition', 'rating'])->get();
        return response()->json($definitionRatings);
    }




    /**
     * Add a Rating to a definition
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
//    public function add(Request $request)
//    {
//        $ratingValue = $request->input('rating');
//

//        $rating = new Rating(['rating_value' => $ratingValue]);
//        $rating->save();

//        $data = $request->all();

//        $definitionRating = DefinitionRating::create($data);
//
//        return response()->json($definitionRating, 201);
//    }

    /**
     * Add a rating to a definition.
     *
     * This endpoint allows you to add a rating to the definition.
     * It's a really useful endpoint, and you should play around
     * with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */
    public function store(Request $request, Definition $definition) {
        $stars = $request->input('stars');
        $definitionId = $request->input('definition_id');
        $definition = Definition::findOrFail($definitionId);


        $rating = Rating::firstOrCreate(['stars' => $stars]);

        if (!$definition->ratings()->where('ratings.id', $rating->id)->exists()) {

            $definition->ratings()->attach($rating->id, ['stars' => $stars, 'user_id' => $request->user()->id]);
        } else {

            $definition->ratings()->updateExistingPivot($rating->id, ['stars' => $stars]);
        }

        return response()->json([
            'message' => 'Rating added or updated successfully',
            'definition' => $definition->definition,
            'stars' => $rating->stars,
        ]);
    }







    /**
     * Update the Rating for a definition
     *
     * @param Request $request
     * @param definitionRating $definitionRating
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Definition $definition) {
        $validatedData = $request->validate([
            'stars' => 'required|integer|min:1|max:10',
        ]);

        $stars = $validatedData['stars'];


        $rating = Rating::firstOrCreate(['stars' => $stars]);


        if (!$definition->ratings()->where('ratings.id', $rating->id)->exists()) {
            $definition->ratings()->attach($rating->id, ['stars' => $stars]);
        } else {

            $definition->ratings()->updateExistingPivot($rating->id, ['stars' => $stars]);
        }

        return response()->json([
            'message' => 'Rating updated successfully',
            'definition' => $definition->definition,
            'stars' => $rating->stars,
        ]);
    }




    /**
     * Remove a definition_rating
     *
     * @param Request $request
     * @param definitionRating $definitionRating
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
     * Complete the definition_raating
     *
     * @param Request $request
     * @param definitionRating $definitionRating
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
