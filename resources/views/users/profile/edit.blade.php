@extends('layouts/app')

@section('content')
    <h3>{{ "Profile" }}</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <a style="color:blue" href="/user/password">Change Password </a>
    <form action="/user/profile" method="post">
        {{ csrf_field() }}
        @method('PUT')
            <label>User</label>
            <input type="text" name="name" id="" value="{{ $user->name }}">
            <br>
            <label>Email</label>
            <input type="text" name="email" id="" value="{{ $user->email }}">
            <input type="submit" value="Lưu">
    </form>
@endsection
