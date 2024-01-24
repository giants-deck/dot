@extends('layouts.base')

@section('docName')
    Create Post
@stop

@section('jQuery')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('dist/js/dropify.js')}}"></script>
@stop


@section('style')
    <link rel="stylesheet" href="{{asset('dist/css/dropify.min.css')}}" type="text/css">
@stop


@section('content')
    <h1 class="display-6 bg-purple-transparent col-12 p-2 rounded-b-3xl text-center">Create New Post</h1>

    <div class="row">

        <div class="col-2">.</div>
        {{ html()->form()->class('col-10')->route('posts.store')->acceptsFiles()->open() }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Title', 'title')->class('d-block fs-18'))
            ->child(html()->text('title')->class('col-9 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Description', 'body')->class('d-block fs-18'))
            ->child(html()->textarea('body')->rows(5)->class('col-9 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Category', 'category_id')->class('d-block fs-18'))
            ->child(html()->select('category_id', [''=>'Choose category'] + $category)->class('col-9 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4 col-9')
            ->child(html()->label('Photo', 'path')->class('d-block fs-18'))
            ->child(html()->file('path')->class('dropify'))
        }}



        {{ html()->button('Create Post')->class('btn btn-purple col-4') }}

        {{ html()->form()->close() }}


    </div>
@stop




@section('scripts')
    <script>
        $('.dropify').dropify();
    </script>
@stop
