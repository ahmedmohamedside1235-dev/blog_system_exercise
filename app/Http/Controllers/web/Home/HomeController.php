<?php

namespace App\Http\Controllers\web\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $data = Blog::latest()->paginate(10);
        return view('pages.home.index', compact('data'));
    }
}
