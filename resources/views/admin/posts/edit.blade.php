@extends('layouts.base')

@section('docName')
    Edit Post
@stop

@section('jQuery')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('dist/js/dropify.js')}}"></script>
@stop


@section('style')
    <link rel="stylesheet" href="{{asset('dist/css/dropify.min.css')}}" type="text/css">
@stop


@section('content')
    <div class="row flex-row-reverse">
        <button class="btn btn-info mb-3 col-2" onclick="history.back()">
            <svg class="d-inline-block align-middle" xmlns="http://www.w3.org/2000/svg" height="19" width="13" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <span class="ml-1 fs-20 align-middle">back</span>
        </button>
    </div>

    <h1 class="display-6 bg-body-tertiary col-12 p-2 rounded-b-3xl text-center">Edit Post</h1>

    <div class="row col-12">

        <div class="col-5">
            <img class="img-thumbnail" src="{{$post->photo()->first() ? $post->photo()->first()->path : asset('dist/images/posthold.jpg')}}" alt="">
        </div>
        {{ html()->modelForm($post, 'PATCH')->class('col-7')->route('posts.update', $post->id)->acceptsFiles()->open() }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Title', 'title')->class('d-block fs-18'))
            ->child(html()->text('title')->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Description', 'body')->class('d-block fs-18'))
            ->child(html()->textarea('body')->rows(5)->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Category', 'category_id')->class('d-block fs-18'))
            ->child(html()->select('category_id', [''=>'Choose category'] + $category)->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4 col-12')
            ->child(html()->label('Photo', 'path')->class('d-block fs-18'))
            ->child(html()->file('path')->class('dropify'))
        }}

        {{ html()->button('Update Post')->class('btn btn-outline-info col-4') }}

        {{ html()->form()->close() }}

        <div class="row col-12 m-0">
            <div class="col-5">.</div>
            {{ html()->form('DELETE')->class('col-7 mt-3')->route('posts.destroy', $post->id)->open() }}
            {{ html()->button('Delete Post')->class('btn btn-outline-danger col-4') }}
            {{ html()->form()->close() }}
        </div>


    </div>
@stop

@section('scripts')
    <script>
        $('.dropify').dropify();
    </script>
@stop
