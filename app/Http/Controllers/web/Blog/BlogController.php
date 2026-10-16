<?php

namespace App\Http\Controllers\web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private function findPost(string $id)
    {
        $post = Blog::withTrashed()->find($id);

        if (!$post) {
            abort(404);
        }

        return $post;
    }

    public function index()
    {
        $data = Blog::withTrashed()->latest()->paginate(10);
        return view('pages.dashboard.dashboard', compact('data'));
    }

    public function create()
    {
        return view('pages.posts.add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|regex:/^[a-zA-Z]{3,}(\s+[a-zA-Z]{3,})*$/',
                'body' => 'required|regex:/^[A-Za-z0-9\s.,!?\'"():;-]+$/|min:10',
                'author_name' => 'required|regex:/^[a-zA-Z]{3,}(\s+[a-zA-Z]{3,}){0,2}$/',
            ],

            [
                'title.regex' => 'Each word must be at least 3 letters long',
                'body.regex' => 'The Body can contain only English letters, numbers and at least 10 characters',
                'author_name.regex' => 'Each word must be at least 3 letters long (up to 3 words)',
            ]
        );

        Blog::create($request->all());
        return redirect()->route('dashboard.index')->with('success', 'The Post has been added successfully.');
    }

    public function destroy(string $id)
    {
        $post = $this->findPost($id);
        $post->delete();
        return redirect()->back()->with('success', 'The Post has been deleted successfully.');
    }

    public function restore(string $id)
    {
        $post = $this->findPost($id);
        $post->restore();
        return redirect()->back()->with('success', 'The Post has been restore successfully.');
    }

    public function force_delete(string $id)
    {
        $post = $this->findPost($id);
        $post->forceDelete();
        return redirect()->back()->with('success', 'The Post has been force delete successfully.');
    }

    public function edit(string $id)
    {
        $post = $this->findPost($id);
        return view('pages.posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'title' => 'required|regex:/^[a-zA-Z]{3,}(\s+[a-zA-Z]{3,})*$/',
                'body' => 'required|regex:/^[A-Za-z0-9\s.,!?\'"():;-]+$/|min:10',
                'author_name' => 'required|regex:/^[a-zA-Z]{3,}(\s+[a-zA-Z]{3,}){0,2}$/',
            ],

            [
                'title.regex' => 'Each word must be at least 3 letters long',
                'body.regex' => 'The Body can contain only English letters, numbers and at least 10 characters',
                'author_name.regex' => 'Each word must be at least 3 letters long (up to 3 words)',
            ]
        );

        $post = $this->findPost($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->author_name = $request->author_name;
        $post->save();

        return redirect()->route('dashboard.index')->with('success', 'The Post has been updated successfully.');
    }
}
