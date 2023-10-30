<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Definition;
use App\Models\DefinitionRating;
use App\Models\DefinitionRatings;
use App\Models\Rating;
use App\Models\Word;
use Illuminate\Http\Request;
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
    public function get(Request $request, DefinitionRatings $definitionRating): \Illuminate\Http\JsonResponse
    {


        // 如果没有'search'查询参数，返回指定的单词和它的定义
        return response()->json($definitionRating->load('definitions'));
    }


    /**
     * Get all tasks
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $definitionRating = DefinitionRating::all();
        return response()->json($definitionRating);
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
    public function store(Request $request, Word $word) {
        $ratingValue = $request->input('rating');

        // 可能需要额外的验证和授权检查
        $rating = new Rating(['rating_value' => $ratingValue]);
        $rating->save();

        $definitionRating = new DefinitionRating();
        // Assuming you have a definition associated with the word you can set the definition_id
        $definitionRating->definition_id = $word->definitions->first()->id;  // Or however you determine the specific definition
        $definitionRating->rating_id = $rating->id;
        $definitionRating->save();

        // Reload the word instance from the database to get fresh data
        $word->refresh();

        return response()->json([
            'message' => 'Rating added successfully',
            'word' => $word,
            'rating' => $rating
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
        $ratingValue = $request->input('rating');

        $definitionRating = $definition->definitionRatings()->where('user_id', auth()->id())->first();

        if (!$definitionRating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        $definitionRating->rating->update(['rating_value' => $ratingValue]);

        return response()->json(['message' => 'Rating updated successfully']);
    }


    /**
     * Remove task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Definition $definition) {
        $definitionRating = $definition->definitionRatings()->where('user_id', auth()->id())->first();

        if (!$definitionRating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        $definitionRating->rating->delete();

        return response()->json(['message' => 'Rating deleted successfully']);
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
