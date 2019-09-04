@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/post">Post</a></li>
            <li class="breadcrumb-item " aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="panel panel-default">
            <div class="panel-heading"><h1>Edit Post</h1></div>
            <div class="panel-body">
                <post-edit  :categories="{{ $categories }}" id="{{ $post->id }}" :posts="{{ $posts }}" active="{{ $post->active }}" published="{{ $post->published_at }}" categoryId="{{ $post->category_id }}"></post-edit>
            </div>
    </div>
@endsection

