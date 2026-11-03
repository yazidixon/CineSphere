<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
} 