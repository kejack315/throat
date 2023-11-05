<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
//    public function index(Request $request): View
//    {
//        $data = User::latest()->paginate(5);
//        return view('users.index',compact('data'))
//            ->with('i', ($request->input('page', 1) - 1) * 5);
//    }
//    public function create(): View
//    {
//        $roles = Role::pluck('name','name')->all();
//        return view('users.create',compact('roles'));
//    }
//
//    public function store(Request $request): RedirectResponse
//
//    {
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|same:confirm-password',
//            'roles' => 'required'
//        ]);
//        $input = $request->all();
//        $input['password'] = Hash::make($input['password']);
//        $user = User::create($input);
//        $user->assignRole($request->input('roles'));
//        return redirect()->route('users.index')
//            ->with('success','User created successfully');
//    }
//    public function show($id): View
//    {
//        $user = User::find($id);
//        return view('users.show',compact('user'));
//    }
//    public function edit($id): View
//
//    {
//        $user = User::find($id);
//        $roles = Role::pluck('name','name')->all();
//        $userRole = $user->roles->pluck('name','name')->all();
//        return view('users.edit',compact('user','roles','userRole'));
//    }
//    public function update(Request $request, $id): RedirectResponse
//    {
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:users,email,'.$id,
//            'password' => 'same:confirm-password',
//            'roles' => 'required'
//        ]);
//        $input = $request->all();
//        if(!empty($input['password'])){
//            $input['password'] = Hash::make($input['password']);
//        }else{
//
//            $input = Arr::except($input,array('password'));
//        }
//
//        $user = User::find($id);
//        $user->update($input);
//        DB::table('model_has_roles')->where('model_id',$id)->delete();
//        $user->assignRole($request->input('roles'));
//        return redirect()->route('users.index')
//
//            ->with('success','User updated successfully');
//
//    }
//    public function destroy($id): RedirectResponse
//    {
//        User::find($id)->delete();
//        return redirect()->route('users.index')
//            ->with('success','User deleted successfully');
//    }
    function __construct()

    {
        $this->middleware('permission:user_browse|user_create|user_edit|user_delete', ['only' => ['index','store']]);
        $this->middleware('permission:user_create', ['only' => ['create','store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user_delete', ['only' => ['destroy']]);

    }
    public function index()
    {
        $users = User::query()->latest()->paginate(5);
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
