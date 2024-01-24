@extends('layouts.base')

@section('docName')
    Create User
@stop

@section('jQuery')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('dist/js/dropify.js')}}"></script>
@stop


@section('style')
    <link rel="stylesheet" href="{{asset('dist/css/dropify.min.css')}}" type="text/css">
@stop


@section('content')
    <h1 class="display-6 bg-secondary-transparent col-12 p-2 rounded-b-3xl text-center">Create New User</h1>

    <div class="row">

        <div class="col-2">.</div>
        {{ html()->form()->class('col-10')->route('users.store')->acceptsFiles()->open() }}

            {{ html()->div()->class('form-group mb-4')
                ->child(html()->label('Name', 'name')->class('d-block fs-18'))
                ->child(html()->text('name')->class('col-9 rounded-br-2xl'))
            }}

            {{ html()->div()->class('form-group mb-4')
                ->child(html()->label('Email', 'email')->class('d-block fs-18'))
                ->child(html()->email('email')->class('col-9 rounded-br-2xl'))
            }}

            {{ html()->div()->class('form-group mb-4')
                ->child(html()->label('Password', 'password')->class('d-block fs-18'))
                ->child(html()->password('password')->class('col-9 rounded-br-2xl'))
            }}

            {{ html()->div()->class('form-group mb-4 col-9')
                ->child(html()->label('Photo', 'path')->class('d-block fs-18'))
                ->child(html()->file('path')->class('dropify'))
            }}

            {{ html()->div()->class('form-group mb-4')
                ->child(html()->label('Role', 'role')->class('d-block fs-18'))
                ->child(html()->select('role_id', [''=>'Choose role of this user'] + $roles)->class('col-9 rounded-br-2xl'))
            }}

            {{ html()->div()->class('form-group mb-4')
                ->child(html()->label('Status', 'is_active')->class('d-block fs-18'))
                ->child(html()->span()
                ->child(html()->radio('is_active')->value(1)->id('active'))
                ->child(html()->label('Active', 'active')->class('ml-2 badge bg-secondary')))
                ->child(html()->radio('is_active')->value(0)->id('inactive')->class('ml-4'))
                ->child(html()->label('Inactive', 'inactive')->class('ml-2 badge bg-danger'))
            }}



            {{ html()->button('Create User')->class('btn btn-primary col-4') }}

        {{ html()->form()->close() }}


    </div>
@stop




@section('scripts')
    <script>
        $('.dropify').dropify();
    </script>
@stop
