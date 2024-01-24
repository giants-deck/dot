@extends('layouts.base')

@section('docName')
    Posts Index
@stop

@section('content')
    <div class="row">


        @foreach($posts as $post)
                <div class="card col-4">
                    <a href="{{route('home.post', $post->id)}}">
                        <img class="card-img-top" height="20" src="{{$post->photo()->first() ? $post->photo()->first()->path : asset('dist/images/posthold.jpg')}}" alt="post image">
                        <div class="card-body d-flex flex-column">
                            <h4 class="fw-normal">{{Str::limit($post->title, 30)}}</h4>
                            <div class="text-muted">{{Str::limit($post->body, 80)}}</div>
                            <div class="d-flex align-items-center pt-4 mt-auto">
                                <div class="avatar avatar-rounded avatar-md me-3 cover-image" data-bs-image-src=""><img src="{{$post->user->photo ? $post->user->photo->path : asset('dist/images/hold.jpeg')}}" alt=""></div>
                                <div>
                                    <p class="text-default m-0">{{$post->user->name}}</p>
                                    <small class="d-block text-muted">{{$post->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        @endforeach


    </div>
@stop
