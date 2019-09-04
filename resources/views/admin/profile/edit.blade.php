@extends('layouts/app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
        <li class="breadcrumb-item ">Admin Profile</li>
    </ol>
</nav>
<div class="panel panel-default">
    <div class="panel-heading"><h1>{{ "Profile" }}</h1></div>
    <div class="panel-body">
        <a class="badge badge-primary" href="/admin/password">Change Password</a><br>
        <br><profile-edit name="{{ Auth::user()->name }}" email="{{ Auth::user()->email }}"></profile-edit>
    </div>
</div>
@endsection
