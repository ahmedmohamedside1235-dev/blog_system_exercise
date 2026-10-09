<div class="post border border-light rounded-2 p-4 mb-4">
    <div class="box position-relative">
        <div class="row ">
            @if ($post->deleted_at)
                <span class="badge text-bg-danger position-absolute top-0 end-0" style="width: fit-content">Deleted</span>
            @endif
            <div class="col-lg-2">
                <div class="item text-center">
                    <img src="{{ Vite::asset('resources/images/default.png') }}" class="img-fluid rounded-2"
                        alt="">
                    <h3 class="mt-3 mb-0">{{ $post->author_name }}</h3>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="item">
                    <h4>{{ $post->title }}</h4>
                    <h5>Created at : {{ $post->created_at }}</h5>
                    @if ($post->deleted_at)
                        <h5>Deleted at : {{ $post->deleted_at }}</h5>
                    @endif
                    <p>{{ substr($post->body, 0, 150) }}...</p>
                    @if ($isDashboard && !$post->deleted_at)
                        <div class="operations">
                            <a href="{{ route('dashboard.edit', ['id' => $post->id]) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('dashboard.destroy', ['id' => $post->id]) }}"
                                class="btn btn-warning">Delete</a>
                            <a href="{{ route('dashboard.force_delete', ['id' => $post->id]) }}"
                                class="btn btn-danger">Force Delete</a>
                        </div>
                    @elseif($isDashboard && $post->deleted_at)
                        <a href="{{ route('dashboard.restore', ['id' => $post->id]) }}"
                            class="btn btn-primary">Restore</a>
                        <a href="{{ route('dashboard.force_delete', ['id' => $post->id]) }}"
                            class="btn btn-danger">Force Delete</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
