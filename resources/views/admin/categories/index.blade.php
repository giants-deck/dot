@extends('layouts.base')

@section('docName')
    Categories Index
@stop

@section('content')
    <h1 class="display-6 border-l-8 border-l-cyan-600 p-3">All Categories</h1>

    <div class="row col-12">
        <div class="col-5">
            {{ html()->form('POST')->route('categories.store')->open() }}

                {{ html()->div()->class('form-group mb-4')
                    ->child(html()->label('Category', 'cat_name')->class('d-block fs-18 mb-2'))
                    ->child(html()->text('cat_name')->attribute('autocomplete', 'off')->class('col-12')->id('catName'))
                }}

            {{ html()->form()->close() }}
        </div>

        <div class="col-1"></div>

        <div class="col-6">
            <div class="table-responsive">
                <table class="table text-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Category Name</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                            @foreach(\App\Models\Category::orderBy('cat_name', 'asc')->get() as $category)
                                <tr>
                                    <td>{{$category->cat_name}}</td>
                                    <td>{{$category->created_at->diffForHumans()}}</td>
                                    <td>{{$category->updated_at->diffForHumans()}}</td>
                                    <td>

                                        <div class="hstack gap-2 flex-wrap">

                                                <a href="{{route('categories.edit', $category->id)}}" class="text-info fs-16 lh-1">
                                                    <i class="ri-edit-line"></i>
                                                </a>


                                                {{ html()->form('DELETE')->route('categories.destroy', $category->id)->open() }}

                                                <button href="" class="text-danger fs-16 lh-1">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                </button>

                                                {{ html()->form()->close() }}
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        const fieldName = document.getElementById('catName');

        fieldName.focus();
    </script>
@stop
