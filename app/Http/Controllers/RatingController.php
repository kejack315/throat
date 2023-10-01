<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * Display a listing of the Rating Resource.
     */
    public function index()
    {
//        $ratings = Rating::all();
        $ratings = Rating::paginate(5);
        return view('ratings.index', compact(['ratings']));
    }

    /**
     * Show the form for creating a new Rating Resource.
     */
    public function create()
    {
        return view('ratings.add');
    }

    /**
     * Store a newly created Rating resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $details = $request->validated();
        $rating = Rating::create($details);
        return redirect(route('ratings.index'))
            ->with('created', $rating->name)
            ->with('messages', true);
    }

    /**
     * Display the specified resource.
     *
     * show(Rating $rating) <--- Route-Model binding
     * retrieve the $rating from the Rating Model and return its
     * contents or fail (404)
     */
    public function show(Rating $rating)
    {
        if ($rating === null) {
            return view('errors.rating_not_found');
            // 处理找不到评分的情况
        }

        return view('ratings.show', compact(['rating']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        return view('ratings.edit', compact(['rating']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $id = $rating->id;
        $validated = $request->validated();
        $rating->update($validated);

//        $newName = $validated->name;
//        $newIcon = $validated->icon;
//        $newStars = $validated->stars;
//        $newName = $validated->name;
//        $newIcon = $validated->icon;
//        $newStars = $validated->stars;
//        $rating->update([
//            'name' => $newName,
//            'stars' => $newStars,
//            'icon' => $newIcon,
//        ]);

        return redirect(route('ratings.index'))
            ->with('updated', "{$rating->name}")
            ->with('messageType', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Rating $rating)
    {
        return view('ratings.delete', compact(['rating']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $oldRating = $rating;
        $rating->delete();
        return redirect(route('ratings.index'))->with('deleted', "{$oldRating->name}");
    }
}
