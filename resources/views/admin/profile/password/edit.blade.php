@extends('layouts/app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/profile">Admin Profile</a></li>
            <li class="breadcrumb-item " aria-current="page">Change Password</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "Password" }}</h1></div>
        <div class="panel-body">
            <password-edit ></password-edit>
        </div>
    </div>
@endsection
