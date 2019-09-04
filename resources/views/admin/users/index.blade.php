@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">User</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "User" }}</h1></div>
        <div class="panel-body">
            <a href="user/create" class="badge badge-primary">Create User</a>
        </div>
        <user-index></user-index>
    </div>
@endsection
