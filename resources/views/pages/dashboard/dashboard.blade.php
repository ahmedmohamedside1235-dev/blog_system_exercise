@extends('layout.app')
@section('title', 'Dashboard page')


@section('content')
    <div class="container mt-5">
        <a href="{{ route('dashboard.create') }}" class="btn mb-4 btn-success w-100 ">Create New Post</a>

        @session('success')
            <p class="alert text-center alert-success w-100 mb-5 success-message">{{ $value }}</p>
        @endsession

        @foreach ($posts as $post)
            <x-blog :$post :isDashboard="true"></x-blog>
        @endforeach
    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
