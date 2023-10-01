<?php

namespace App\Http\Controllers;

use App\Models\WordType;
use App\Http\Requests\StoreWordTypeRequest;
use App\Http\Requests\UpdateWordTypeRequest;

class WordTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * todo: add a route to the word types index method
     * todo: make the index method display the wordtypes.index view
     * todo: create the wordtypes/index.blade.php file and
     *       display the word types in a table
     * todo: add pagination to the table & controller method to
     *       show 5 word types at a time
     */
    public function index()
    {
        $wordTypes = WordType::paginate(5);
        return view('wordtypes.index',compact(['wordTypes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * This is an example of Route-Model Binding
     * The route will be:
     * Route::get('/wordtypes/{wordType}',
     *     [\App\Http\Controllers\WordTypeController::class, 'show']
     * )->name('wordtypes.show');
     */
    public function show(WordType $wordType)
    {
        return view('wordtypes.show', compact(['wordType']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WordType $wordType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWordTypeRequest $request, WordType $wordType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WordType $wordType)
    {
        //
    }
}
