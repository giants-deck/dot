@extends('layouts.base')

@section('docName')
    Edit User
@stop

@section('jQuery')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('dist/js/dropify.js')}}"></script>
@stop


@section('style')
    <link rel="stylesheet" href="{{asset('dist/css/dropify.min.css')}}" type="text/css">
@stop


@section('content')
    <div>
        <button class="btn btn-orange-ghost mb-3 col-2" onclick="history.back()">Back</button>
    </div>

    <h1 class="display-6 bg-orange-transparent col-12 p-2 rounded-b-3xl text-center">Edit User</h1>

    <div class="row col-12">

        <div class="col-4">
            <img class="img-thumbnail" src="{{$user->photo ? $user->photo->path : asset('dist/images/hold.jpeg')}}" alt="">
        </div>

        <div class="col-1"></div>

        {{ html()->modelForm($user, 'PATCH')->class('col-6')->route('users.update', $user->id)->acceptsFiles()->open() }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Name', 'name')->class('d-block fs-18'))
            ->child(html()->text('name')->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Email', 'email')->class('d-block fs-18'))
            ->child(html()->email('email')->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Password', 'password')->class('d-block fs-18'))
            ->child(html()->password('password')->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4 col-12')
            ->child(html()->label('Photo', 'path')->class('d-block fs-18'))
            ->child(html()->file('path')->class('dropify'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Role', 'role')->class('d-block fs-18'))
            ->child(html()->select('role_id', [''=>'Choose role of this user'] + $roles)->class('col-12 rounded-br-2xl'))
        }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Status', 'is_active')->class('d-block fs-18'))
            ->child(html()->span()
            ->child(html()->radio('is_active')->value(1)->checked(old('is_active', $user->is_active === 1))->id('active'))
            ->child(html()->label('Active', 'active')->class('ml-2 badge bg-secondary')))
            ->child(html()->radio('is_active')->value(0)->checked(old('is_active', $user->is_active === 0))->id('inactive')->class('ml-4'))
            ->child(html()->label('Inactive', 'inactive')->class('ml-2 badge bg-danger'))
        }}



        {{ html()->button('Update User')->class('btn btn-orange col-4') }}

        {{ html()->closeModelForm() }}


    </div>
@stop




@section('scripts')
    <script>
        $('.dropify').dropify();
    </script>
@stop
