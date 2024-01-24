@extends('layouts.blogbase')

@section('docName')
    Comment Check
@stop

@section('content')
    <div class="row flex-row-reverse">
        <button class="btn btn-info mb-3 col-2" onclick="history.back()">
            <svg class="d-inline-block align-middle" xmlns="http://www.w3.org/2000/svg" height="19" width="13" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <span class="ml-1 fs-20 align-middle">back</span>
        </button>
    </div>


    <div class="container">

        <div class="bg-primary-transparent p-3 mb-4 fs-17">

            <table>
                <tr>
                    <td><strong>Comment Author</strong></td>
                    <td class="col-2 text-center">:</td>
                    <td>{{$comment->author}}</td>
                </tr>
                <tr>
                    <td><strong>Comment Author Email</strong></td>
                    <td class="col-2 text-center">:</td>
                    <td>{{$comment->email}}</td>
                </tr>
                <tr>
                    <td><strong>Commented</strong></td>
                    <td class="col-2 text-center">:</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td class="col-2 text-center">:</td>
                    <td class="{{$comment->is_active == 1 ? 'badge bg-info' : 'badge bg-danger'}} fs-17">{{$comment->is_active == 1 ? 'Approved' : 'Disapproved'}}</td>
                </tr>
            </table>
        </div>


        <p class="display-6">Comment Body :</p>
        <div class="form-control">
            <p class="fs-22">{{$comment->body}}</p>
        </div>
    </div>

    <div>
        @if($comment->is_active == 0)
            {{ html()->modelForm($comment, 'PATCH')->class('')->route('comments.update', $comment->id)->open() }}
            {{ html()->hidden('is_active', 1) }}
            {{ html()->button('Approve')->class('btn btn-info float-end mt-4') }}
            {{ html()->closeModelForm() }}
        @else
            {{ html()->modelForm($comment, 'PATCH')->class('')->route('comments.update', $comment->id)->open() }}
            {{ html()->hidden('is_active', 0) }}
            {{ html()->button('Disapprove')->class('btn btn-orange float-end mt-4') }}
            {{ html()->closeModelForm() }}
        @endif
    </div>
@stop
