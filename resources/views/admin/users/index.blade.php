@extends('layouts.base')

@section('docName')
    Users Index
@stop


@section('content')
    @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table text-nowrap table-bordered">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col" class="{{\Illuminate\Support\Facades\Auth::user()->isAdmin() || \Illuminate\Support\Facades\Auth::user()->role->role_name == 'Author' ? 'd-block' : 'd-none'}}">Action</th>
                </tr>
                </thead>
                <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                                            <span class="avatar avatar-xs me-2 avatar-rounded">
                                                                <img src="{{$user->photo ? $user->photo->path : asset('dist/images/hold.jpeg')}}" alt="img">
                                                            </span><span  class="fs-6">{{$user->name}}</span>
                                    </div>
                                </th>
                                <td  class="fs-6"><span class="{{$user->role ? ($user->role->role_name == 'Administrator' ?  $css['administrator'] : ($user->role->role_name == 'Author' ? $css['author'] : ($user->role->role_name == 'Subscriber' ? $css['subscriber'] : $css['no']))) : $css['no']}}">{{$user->role ? $user->role->role_name : 'Has No Role'}}</span></td>
                                <td  class="fs-6"><span class="{{$user->is_active == 1 ? 'badge bg-primary-transparent' : 'badge bg-danger-transparent'}}">

                                        {{$user->is_active == 1 ? 'Active' : 'Inactive'}}
                                    </span></td>
                                <td class="fs-6">{{$user->email}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                                <td class="{{\Illuminate\Support\Facades\Auth::user()->isAdmin() || \Illuminate\Support\Facades\Auth::user()->role->role_name == 'Author' ? 'd-block' : 'd-none'}}">
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="{{route('users.edit', $user->id)}}" class="text-info fs-14 lh-1"><i
                                                class="ri-edit-line"></i></a>
                                        {{ html()->form('DELETE')->class(\Illuminate\Support\Facades\Auth::user()->isAdmin() ? 'd-block' : 'd-none')->route('users.destroy', $user->id)->open() }}

                                        <button href="" class="text-danger fs-14 lh-1"><i
                                                class="ri-delete-bin-5-line"></i></button>

                                        {{ html()->form()->close() }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    @else
        @include('includes.nodata')
    @endif
@stop
