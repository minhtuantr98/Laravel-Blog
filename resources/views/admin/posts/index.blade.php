@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Post</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "Post" }}</h1></div>
        <div class="panel-body">
                <a class="badge badge-primary" href="/admin/post/create">Create Post </a>
        </div><br>
        <post-index></post-index>
    </div>
@endsection
