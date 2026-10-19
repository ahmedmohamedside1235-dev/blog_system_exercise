@extends('layout.app')
@section('title', 'Add new post')

@section('content')
    <div class="container my-5">
        <form action="{{ route('dashboard.store') }}" method="POST" class="m-auto mt-5">
            @csrf
            <h3 class="text-center mb-4"><i class="fa-solid fa-folder-plus"></i> Add New Post</h3>
            <div class="mb-3">
                <label for="Author" class="form-label">Author</label>
                <input type="text" class="form-control" id="Author" value="{{ old('author_name') }}" name="author_name">
                @error('author_name')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="Title" name="title" value="{{ old('title') }}">
                @error('title')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="Body" class="form-label">Body</label>
                <textarea rows="10" style="resize: none" class="form-control" id="Body" name="body">
                    {{ old('body') }}
                </textarea>
                @error('body')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn w-100">Add</button>
        </form>
    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
