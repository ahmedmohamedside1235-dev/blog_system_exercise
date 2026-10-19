<div class="post mb-4 p-4">
    <div class="box position-relative">
        <div class="row">
            @if ($post->deleted_at)
                <span class="badge text-bg-danger position-absolute top-0 end-0" style="width: fit-content">Deleted</span>
            @endif
            <div class="col-md-4 col-lg-2 par1 align-items-center d-flex">
                <div class="item text-center">
                    <img src="{{ Vite::asset('resources/images/default.png') }}" class="img-fluid rounded-2"
                        alt="">
                    <h4 class="mt-3 mb-0">{{ $post->author_name }}</h4>
                </div>
            </div>
            <div class="col-md-8 col-lg-10 part2">
                <div class="item">
                    <h4>{{ $post->title }}</h4>

                    @if (!$post->deleted_at)
                        <h5>{{ $post->created_at }}</h5>
                    @endif

                    @if ($post->deleted_at)
                        <h5>Deleted - {{ $post->deleted_at }}</h5>
                    @endif

                    <p>{{ substr($post->body, 0, 150) }}...</p>

                    @if ($isDashboard && !$post->deleted_at)
                        <div class="operations d-flex align-items-center">
                            <a href="{{ route('dashboard.edit', ['id' => $post->id]) }}" class="btn me-2 btn-info"><i
                                    class="fa-solid fa-pencil"></i> Edit</a>
                            <a href="{{ route('dashboard.destroy', ['id' => $post->id]) }}"
                                class="btn me-2 btn-warning"><i class="fa-solid fa-trash"></i> Delete</a>
                            <a href="{{ route('dashboard.force_delete', ['id' => $post->id]) }}"
                                class="btn me-2 btn-danger"><i class="fa-solid fa-ban"></i> Force Delete</a>
                        </div>
                    @elseif($isDashboard && $post->deleted_at)
                        <a href="{{ route('dashboard.restore', ['id' => $post->id]) }}" class="btn me-2 btn-primary"><i
                                class="fa-solid fa-rotate-right"></i> Restore</a>
                        <a href="{{ route('dashboard.force_delete', ['id' => $post->id]) }}"
                            class="btn me-2 btn-danger"><i class="fa-solid fa-ban"></i> Force Delete</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
