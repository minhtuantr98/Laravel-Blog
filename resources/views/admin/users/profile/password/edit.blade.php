@extends('layouts/app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
        <li class="breadcrumb-item "><a href="/admin/user">User</a></li>
        <li class="breadcrumb-item "><a href="/admin/user/{{ $id }}/edit">Profile</a></li>
        <li class="breadcrumb-item " aria-current="page">Password Reset</li>
    </ol>
</nav>
<div class="panel panel-default">
    <div class="panel-heading"><h1>{{ "Password" }}</h1></div>
    <div class="panel-body">
        <user-password id="{{ $id }}"></user-password>
    </div>
</div>
@endsection
