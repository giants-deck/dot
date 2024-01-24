@extends('layouts.base')

@section('docName')
    Comments
@stop

@section('content')

    <div class="row">
        <a href="{{route('comments.index')}}" class="d-inline-flex justify-content-end">
            <button class="btn btn-info mb-3 col-2">
                <svg class="d-inline-block align-middle" xmlns="http://www.w3.org/2000/svg" height="19" width="13" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                <span class="ml-1 fs-20 align-middle">back</span>
            </button>
        </a>
    </div>

    @if($comments->count() > 0)
        <h1>Comments</h1>

        <div class="table-responsive">
            <table class="table text-nowrap table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>View</th>
                    <th>Comment Created</th>
                    <th>Approval</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>
                            {{ html()->a(route('home.comment', $comment->id))->child(html()->button('Show This Comment')->class('btn btn-dark')) }}
                        </td>

                        <td>{{$comment->created_at->diffForHumans()}}</td>

                        <td>
                            @if($comment->is_active == 0)
                                {{ html()->modelForm($comment, 'PATCH')->route('comments.update', $comment->id)->open() }}
                                {{ html()->hidden('is_active', 1) }}
                                {{ html()->button('Approve')->class('btn btn-info') }}
                                {{ html()->closeModelForm() }}
                            @else
                                {{ html()->modelForm($comment, 'PATCH')->route('comments.update', $comment->id)->open() }}
                                {{ html()->hidden('is_active', 0) }}
                                {{ html()->button('Disapprove')->class('btn btn-orange') }}
                                {{ html()->closeModelForm() }}
                            @endif
                        </td>

                        <td>
                            {{ html()->form('DELETE')->class('')->route('comments.destroy', $comment->id)->open() }}
                            {{ html()->button('Delete')->class('btn btn-danger') }}
                            {{ html()->form()->close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h1>No Comments</h1>
    @endif
@stop
