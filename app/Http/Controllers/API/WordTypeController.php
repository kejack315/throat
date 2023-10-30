<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WordTypeController extends Controller
{
    /**
     * Get a task
     *
     * @param Request $request

     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, WordType $wordType): \Illuminate\Http\JsonResponse
    {
        return response()->json($wordType);
    }

    /**
     * Get all tasks
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(WordType::all());
    }

    /**
     * Add task
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'name' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $wordType = new WordType();
            $wordType->name = $request->get('name');
            $wordType->code = $request->get('code');



            if ($wordType->saveOrFail()) {
                return response()->json($wordType);
            }

        } catch (Exception $e) {
            Log::debug('error creating task');
        }

        return response()->json('error_creating', 400);
    }

    /**
     * Update the task
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, WordType $wordType): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->post(), [
            'name' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            if($request->has('name')){
                $wordType->name = $request->get('name');
            }
            if($request->has('code')){
                $wordType->code = $request->get('code');
            }


            if ($wordType->updateOrFail()) {
                return response()->json($wordType);
            }

        } catch (Exception $e) {
            Log::debug('error updating task', ['id' => $wordType->id]);
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
    public function remove(Request $request, WordType $wordType): \Illuminate\Http\JsonResponse
    {
        if ($wordType->delete()) {
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
    public function complete(Request $request, WordType $wordType): \Illuminate\Http\JsonResponse
    {
        try {
            $wordType->completed = true;
            if ($wordType->saveOrFail()) {
                return response()->json(null, 204);
            }
        } catch (Exception $e) {
            Log::debug('error completing task.', ['id' => $wordType->id]);
        }

        return response()->json('error_completing', 400);
    }
}
