<?php

namespace App\Http\Controllers\api\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private function findPost(string $id)
    {
        $post = Blog::withTrashed()->find($id);
        if (!$post) return false;
        return $post;
    }

    public function getAll()
    {
        return response()->json(Blog::withTrashed()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'author_name' => 'required',
        ]);

        Blog::create($request->all());
        return response()->json(['message' =>  'The Post has been added successfully.']);
    }

    public function destroy(string $id)
    {
        $post = $this->findPost($id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->delete();
        return response()->json(['message' =>  'The Post has been deleted successfully.']);
    }

    public function restore(string $id)
    {
        $post = $this->findPost($id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->restore();
        return response()->json(['message' =>  'The Post has been restore successfully.']);
    }

    public function force_delete(string $id)
    {
        $post = $this->findPost($id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->forceDelete();
        return response()->json(['message' =>  'The Post has been force delete successfully.']);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'author_name' => 'required',
        ]);

        $post = $this->findPost($id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->author_name = $request->author_name;
        $post->save();
        return response()->json(['message' =>  'The Post has been updated successfully.']);
    }
}
