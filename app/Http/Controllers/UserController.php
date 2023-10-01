<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->paginate(10);

        return view('users.index',compact('users'));
    }

    public function create()
    {

        return view('users.create');
    }
    public function show(User $user)
    {

        return view('users.show', compact(['user']));
    }

    public function edit(User $user)
    {

        return view('users.edit', compact(['user']));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        return view('users.delete', compact(['user']));
    }
    public function store(StoreUserRequest $request)
    {
        $details = $request->validated();
        $user = User::create($details);
        return redirect(route('users.index'))
            ->with('created', $user->name)
            ->with('messages', true);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $id = $user->id;
        $validated = $request->validated();
        $user->update($validated);

        return redirect(route('users.index'))
            ->with('updated', "{$user->name}")
            ->with('messageType', 'updated');
    }

    public function destroy(User $user)
    {
        $oldUser = $user;
        $user->delete();
        return redirect(route('users.index'))->with('deleted', "{$oldUser->name}");
    }
}
