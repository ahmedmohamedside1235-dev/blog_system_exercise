@extends('layout.app')
@section('title', 'Dashboard page')


@section('content')
    <div class="container mt-5">
        <div class="head d-flex align-items-center justify-content-between w-100 mb-5">
            <div class="info">
                <h3 class="mb-2 ">Dashboard</h3>
                <p class="mb-0">Manage your posts</p>
            </div>
            <div class="add_post">
                <a href="{{ route('dashboard.create') }}" class="btn add_anchor">+ New Post</a>
            </div>
        </div>

        @session('success')
            <p class="alert text-center alert-success w-100 mb-5 success-message">{{ $value }}</p>
        @endsession

        @forelse ($data as $post)
            <x-blog :$post :isDashboard="true"></x-blog>
        @empty
            <p class="alert alert-success w-100 text-center">No posts founded</p>
        @endforelse

        <div class="my-5">
            @if ($data->lastPage() > 1)
                {{ $data->links() }}
            @endif
        </div>

    </div>
@endsection

@section('navbar')
    @include('shared.navbar')
@endsection
