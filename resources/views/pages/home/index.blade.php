@extends('layout.app')
@section('title', 'Home page')


@section('content')
    <div class="container mt-5">
        @foreach ($posts as $post)
            <x-blog :$post :isDashboard="false"></x-blog>
        @endforeach
    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
