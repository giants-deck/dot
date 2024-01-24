@extends('layouts.base')

@section('docName')
    Edit Category
@stop

@section('content')
    <div>
        <h1>Edit Category</h1>

        {{ html()->modelForm($category, 'PATCH')->route('categories.update', $category->id)->open() }}

        {{ html()->div()->class('form-group mb-4')
            ->child(html()->label('Category', 'cat_name')->class('d-block fs-18 mb-2'))
            ->child(html()->text('cat_name')->attribute('autocomplete', 'off')->class('col-12')->id('catName'))
        }}

        {{ html()->closeModelForm() }}
    </div>
@stop
