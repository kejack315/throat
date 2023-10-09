<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Rating;
use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
//    public function index()
//    {
//        $user = Auth::user();
//        $definitions = Definition::where('user_id', $user->id)->get();
//        $words = Word::where('user_id', $user->id)->get();
//        $wordTypes = WordType::all();
//
//        return view('dashboard', compact('user', 'definitions', 'words', 'wordTypes'));
//    }
    public function index()
    {
        $this->middleware('auth');

        // 获取当前已登录用户
        $user = Auth::user();
        $definitions = Definition::where('user_id', $user->id)->get();
        $words = Word::where('user_id', $user->id)->get();
        $wordTypes = WordType::all();
        // 获取 Top 5 Defined Words
        $topDefinedWords = Word::withCount('definitions')
            ->orderByDesc('definitions_count')
            ->limit(5)
            ->get();

//         获取 Top 5 Highest Rated Definitions

        $topRatedDefinitions = Definition::with('ratings') // 预加载评级关联
        ->get() // 获取所有定义
        ->sortByDesc(function ($definition) {
            return $definition->averageRating();
        })
            ->take(5); // 获取前五个定义


        // 获取用户的权限
        $permissions = [];

        if ($user->roles == 'admin') {
            $permissions = ['all permission'];
        }

        return view('dashboard', compact('user', 'user', 'definitions', 'words', 'wordTypes','topRatedDefinitions','topDefinedWords',  'permissions'));
    }



}
