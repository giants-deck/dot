@extends('layouts.base')

@section('docName')
    Show Post
@stop

@section('content')

    <div class="row flex-row-reverse">
        <button class="btn btn-info mb-3 col-2" onclick="history.back()">
            <svg class="d-inline-block align-middle" xmlns="http://www.w3.org/2000/svg" height="19" width="13" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <span class="ml-1 fs-20 align-middle">back</span>
        </button>
    </div>

    <div class="row">
        <div class="col-3">
            <img class="img-fluid img-thumbnail " height="50" src="{{$post->photo()->first() ? $post->photo()->first()->path : asset('dist/images/posthold.jpg')}}" alt="">
        </div>
        <div class="col-9">
            <p class="display-5 text-justify">{{$post->title}}</p>

        </div>


        <div class="row col-lg-12 mb-3">
            <div class="col-lg-7"></div>
                <span class="col-lg-5 text-center pt-2 pb-2 bg-primary bg-opacity-50">
                        <span class="ml-2">{{$post->category ? $post->category->cat_name : 'Uncategorized'}}</span>
                        <span>
                            <svg id="svgOwner" class="d-inline-block ml-2" xmlns="http://www.w3.org/2000/svg" height="10" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                            <span class="ml-2">{{$post->created_at->diffForHumans()}}</span>
                        </span>
                        <span class="">
                            <svg id="svgOwner" class="d-inline-block ml-2" xmlns="http://www.w3.org/2000/svg" height="10" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                            <div class="avatar avatar-rounded avatar-md align-middle ml-2  cover-image" data-bs-image-src=""><img src="{{$post->user->photo ? $post->user->photo->path : asset('dist/images/hold.jpeg')}}" alt=""></div>
                            <span class=""><strong>by {{$post->user->name}}</strong></span>
                        </span>
                </span>
        </div>

        <div class="row">
            <p class="text-justify mt-2 fs-22">Description <span>{{$post->body}}</span></p>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::user()->id == $post->user_id)
        @include('includes.verifieduser')
    @endif

    @include('includes.comments')
@stop
