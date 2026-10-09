<?php

namespace App\Http\Controllers\web\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Blog::get();
        return view('pages.home.index', compact('posts'));
    }
}
