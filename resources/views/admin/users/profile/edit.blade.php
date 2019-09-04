@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/user">User</a></li>
            <li class="breadcrumb-item ">Profile</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "Profile User" }}</h1></div>
        <div class="panel-body">
            <a class="badge badge-primary" href="/admin/user/password/{{ $user->id }}">Reset Password </a><br>
            <br><user-profile id="{{ $user->id }}" name="{{ $user->name }}" email="{{ $user->email }}"></user-profile>
        </div>
    </div>
@endsection
