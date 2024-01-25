@extends('layouts.base')

@section('docName')
    Reply Index
@stop

@section('content')
    @if(count($replies) > 0)

        @foreach($replies as $reply)
            <p>{{$reply->replies}}</p>
        @endforeach

    @endif
@stop
