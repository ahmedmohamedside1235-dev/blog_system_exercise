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
        $posts = Blog::withTrashed()->latest()->get();
        return view('pages.dashboard.dashboard', compact('posts'));
    }

    public function create()
    {
        return view('pages.posts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'author_name' => 'required',
        ]);

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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'author_name' => 'required',
        ]);

        $post = $this->findPost($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->author_name = $request->author_name;
        $post->save();

        return redirect()->route('dashboard.index')->with('success', 'The Post has been updated successfully.');
    }
}
