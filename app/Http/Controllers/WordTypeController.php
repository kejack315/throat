<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Word;
use App\Models\WordType;
use App\Http\Requests\StoreWordTypeRequest;
use App\Http\Requests\UpdateWordTypeRequest;
use Illuminate\Support\Facades\DB;

class WordTypeController extends Controller
{
    function __construct()

    {
        $this->middleware('permission:wordType_browse', ['only' => ['view']]);
        $this->middleware('permission:wordType_create', ['only' => ['create','store']]);
        $this->middleware('permission:wordType_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:wordType_delete', ['only' => ['destroy']]);

    }
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
        $wordTypes = WordType::all();
        return view('wordtypes.create',compact(['wordTypes']));
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
        $wordTypes = WordType::all();
        return view('wordtypes.show', compact(['wordType','wordTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WordType $wordType)
    {
        $wordTypes = WordType::all();
        return view('wordtypes.edit', compact(['wordType','wordTypes']));
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
    public function delete(WordType $wordType)
    {
        $wordTypes = WordType::all();
        return view('wordtypes.delete', compact('wordType','wordTypes'));
    }

    public function destroy($wordTypeId)
    {
        $wordType = WordType::find($wordTypeId);
        $name = $wordType->name;

        // Check if "unknown" WordType exists
        $unknownWordType = WordType::where('name', 'unknown')->first();

        // If it doesn't, create it
        if(!$unknownWordType) {
            $unknownWordType = WordType::create(['name' => 'unknown']);
        }

        // Update the word_type_id in Word and Definition tables before deleting the WordType
        Word::where('word_type_id', $wordTypeId)->update(['word_type_id' => $unknownWordType->id]);
        Definition::where('word_type_id', $wordTypeId)->update(['word_type_id' => $unknownWordType->id]);

        $wordType->delete();
        return redirect(route('wordtypes.index'))->with('deleted', $name);
    }



}
