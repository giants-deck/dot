@extends('layouts.base')

@section('docName')
    Comments
@stop

@section('content')
    @if($posts->count() > 0)
        <h1>Commented Posts</h1>

        <div class="table-responsive">
                <table class="table text-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>View</th>
                            <th>Comments</th>
                            <th>Replies</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($posts as $post)

                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{Str::limit($post->title, 20)}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->user->email}}</td>
                                <td>{{$post->comments()->first()->created_at->diffForHumans()}}</td>
                                <td><a href="{{route('home.post', $post->id)}}"><button class="btn btn-info">View Post</button></a></td>
                                <td><a href="{{route('comments.show', $post->id)}}"><button class="btn btn-success">View Comments</button></a></td>
                                <td>
                                    @if($post->comments()->first()->replies()->first())
                                        <a href="{{route('replies.show', $post->comments()->first()->replies()->first()->comment_id)}}">
                                            <button class="btn btn-outline-dark">Replies</button>
                                        </a>
                                    @else
                                        <i class="fe fe-feather"></i><span class="ml-1">Has No Reply</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    @else
        <h1>There is no commented post found</h1>
    @endif
@stop
