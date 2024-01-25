@extends('layouts.base')

@section('docName')
    Show Replies
@stop

@section('content')
    @if($replies->count() > 0)
        <div class="row">
            <a href="{{route('comments.index')}}" class="d-inline-flex justify-content-end">
                <button class="btn btn-info mb-3 col-2">
                    <svg class="d-inline-block align-middle" xmlns="http://www.w3.org/2000/svg" height="19" width="13" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                    <span class="ml-1 fs-20 align-middle">back</span>
                </button>
            </a>
        </div>

        <p class="display-5">This Comment's {{$replies->count() > 1 ? 'Replies' : 'Reply'}}</p>

        <div class="row">
            @foreach($replies as $reply)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$reply->author}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted mt-2">{{$reply->user->role()->first()->role_name}}</h6>
                        <h6>Comment's Author: {{$reply->comment()->first()->author}}</h6>
                        <hr>
                        <p class="card-text">{{$reply->body}}</p>
                        <hr>

                        <div class="row">
                            <div class="col-4">
                                @if($reply->is_active == 0)
                                    {{ html()->modelForm($reply, 'PATCH')->route('replies.update', $reply->id)->open() }}
                                    {{ html()->hidden('is_active', 1) }}
                                    {{ html()->button('Approve')->class('btn btn-info') }}
                                    {{ html()->closeModelForm() }}
                                @else
                                    {{ html()->modelForm($reply, 'PATCH')->route('replies.update', $reply->id)->open() }}
                                    {{ html()->hidden('is_active', 0) }}
                                    {{ html()->button('Disapprove')->class('btn btn-orange') }}
                                    {{ html()->closeModelForm() }}
                                @endif
                            </div>

                            <div class="ml-8 col-3">
                                {{ html()->form('DELETE')->class('')->route('replies.destroy', $reply->id)->open() }}
                                {{ html()->button('Delete')->class('btn btn-danger') }}
                                {{ html()->form()->close() }}
                            </div>
                        </div>



                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2>No Replies</h2>
    @endif

@stop
