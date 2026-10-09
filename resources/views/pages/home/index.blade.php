@extends('layout.app')
@section('title', 'Home page')


@section('content')
    <div class="container mt-5">
        @foreach ($posts as $post)
            <x-blog :$post :isDashboard="false"></x-blog>
        @else
            <p class="alert alert-success w-100 text-center">No posts founded</p>
        @endforeach
    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
