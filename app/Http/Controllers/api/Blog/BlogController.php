<?php

namespace App\Http\Controllers\api\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private function findPost(string $id)
    {
        return Blog::withTrashed()->find($id);
    }

    public function getAll(Request $request)
    {
        $request->validate(['trashed' => 'sometimes|boolean']);

        $query = $request->boolean('trashed') ? Blog::withTrashed() : Blog::query();

        return response()->json($query->latest()->paginate(10, ['*'], 'page', $request->input('page')));
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

        $post = Blog::create($request->all());
        return response()->json([
            'message' =>  'The Post has been added successfully.',
            'post' => $post
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid|string|exists:blog,id',
        ]);

        $post = $this->findPost($request->id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }


        $post->delete();

        return response()->json([
            'message' =>  'The Post has been deleted successfully.',
            'post' => $post->fresh() ?? Blog::withTrashed()->find($request->id)
        ]);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid|string|exists:blog,id',
        ]);

        $post = $this->findPost($request->id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->restore();

        return response()->json([
            'message' =>  'The Post has been restored successfully.',
            'post' => $post->fresh()
        ]);
    }

    public function force_delete(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid|string|exists:blog,id',
        ]);

        $post = $this->findPost($request->id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->forceDelete();
        return response()->json(['message' =>  'The Post has been force delete successfully.']);
    }

    public function update(Request $request)
    {
        $data = $request->validate(
            [
                'id' => 'required|uuid|string|exists:blog,id',
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

        $post = $this->findPost($data['id']);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->author_name = $request->author_name;
        $post->save();

        return response()->json([
            'message' =>  'The Post has been updated successfully.',
            'post' => $post->fresh()
        ]);
    }

    public function getPost(Request $request)
    {
        $request->validate([
            'id' => 'required|uuid|string|exists:blog,id'
        ]);

        $post = $this->findPost($request->id);

        if (!$post) {
            return response()->json(['messeage' => 'The id is not found'], 422);
        }

        return response()->json($post);
    }
}
