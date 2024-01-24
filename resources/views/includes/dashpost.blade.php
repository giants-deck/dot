<div class="row">
    <p class="display-5">Your {{$user->posts->count() > 1 ? 'Posts' : 'Post'}}</p>
    @foreach($user->posts as $post)

        <a href="{{route('posts.show', $post->id)}}">
            <div class="col-xl-12">
                <div class="card custom-card {{$cardColor[array_rand($cardColor, 1)]}}">
                    <div class="card-body">
                        <div class="d-flex align-items-center w-100">
                            <div class="me-4">
                                            <span class="avatar avatar-rounded avatar-xxl img-thumbnail">
                                                <img src="{{$post->photo()->first() ? $post->photo()->first()->path : asset('dist/images/posthold.jpg')}}" alt="img">
                                            </span>
                            </div>
                            <div class="">
                                <div class="fs-15 fw-semibold">{{$post->title}}</div>
                                <p class="mb-0 text-fixed-white op-7 fs-12">{{Str::limit($post->body, 120)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
