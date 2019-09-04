@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/category">Category</a></li>
            <li class="breadcrumb-item " aria-current="page">Create</li>
        </ol>
    </nav> 
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Create Category</h1></div>
        <div class="panel-body">
            <category-create></category-create>
        </div>
    </div>
@endsection
