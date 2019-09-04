@extends('layouts/app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
        <li class="breadcrumb-item "><a href="/admin/user">User</a></li>
        <li class="breadcrumb-item " aria-current="page">Create</li>
    </ol>
</nav> 
<div class="panel panel-default">
    <div class="panel-heading"><h1>Create User</h1></div>
    <div class="panel-body">
        <user-create></user-create>
    </div>
</div>
@endsection
