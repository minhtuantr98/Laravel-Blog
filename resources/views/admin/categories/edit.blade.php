@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/category">Category</a></li>
            <li class="breadcrumb-item " aria-current="page">Edit</li>
        </ol>
    </nav> 
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Edit Category</h1></div>
        <div class="panel-body">
            <category-edit :categories="{{ $category }}"></category-edit>
        </div>
        @isset($value)
            {{ $value }}
        @endisset
    </div>
@endsection