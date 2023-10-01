<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function home(): View
    {
        return view('static.home');
    }

    public function privacyPolicy(): View
    {
        return view('static.privacy'); // 修正拼写错误
    }

    public function contact(): View
    {
        return view('static.contact');
    }
}

