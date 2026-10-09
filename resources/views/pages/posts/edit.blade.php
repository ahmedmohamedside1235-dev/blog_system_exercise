@extends('layout.app')
@section('title', 'Add new post')

@section('content')
    <div class="container my-5">
        <form action="{{ route('dashboard.update', ['id' => $post->id]) }}" method="POST" class="w-50 m-auto mt-5">
            @csrf
            <h3 class="text-center mb-4">Edit Post {{ $post->author_name }}</h3>
            <div class="mb-3">
                <label for="Author" class="form-label">Author</label>
                <input type="text" class="form-control" id="Author" value="{{ $post->author_name }}" name="author_name">
                @error('author_name')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="title" value="{{ $post->title }}">
                @error('title')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Body" class="form-label">Body</label>
                <textarea rows="10" style="resize: none" class="form-control" id="Body" name="body">{{ trim($post->body) }}</textarea>
                @error('body')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 ">Edit</button>
        </form>
    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
