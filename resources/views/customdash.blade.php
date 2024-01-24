@extends('layouts.base')

@section('docName')
    Dashboard
@stop

@section('content')
    <h1 class="fs-22">Welcome</h1>
    <p class="fs-20">{{$user->name}}</p>
    <div id="center">
        <div id="left">
            <p>This is your Dashboard <strong>{{$user->name}}</strong>. You can edit your Profile
                <span class="ml-3">
            <a href="{{route('users.edit', $user->id)}}">
                <button class="btn btn-bd-primary col-2">Profile</button>
            </a>
        </span>
            </p>
        </div>


        <div id="right">
            <img src="{{$user->photo ? $user->photo->path : asset('dist/images/hold.jpeg')}}" alt="">
        </div>
    </div>

    @if($user->posts->count() > 0)
        @include('includes.dashpost')
    @endif

@stop
