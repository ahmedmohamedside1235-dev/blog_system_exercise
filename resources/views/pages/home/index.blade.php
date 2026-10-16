@extends('layout.app')
@section('title', 'Home page')


@section('content')
    <div class="container mt-5">
        @forelse ($data as $post)
            <x-blog :$post :isDashboard="false"></x-blog>
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
