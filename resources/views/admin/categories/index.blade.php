@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Category</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "Category" }}</h1></div>
        <div class="panel-body">
            <a href="category/create" class="badge badge-primary">Create Category</a>
        </div>
        <category-index></category-index>
    </div>
@endsection
