@extends('layouts/app')

@section('content')
    <h3>{{ "Change Password" }}</h3>
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
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="/user/password" method="post">
        {{ csrf_field() }}
        @method('PUT')
            <label>Old-Password</label>
            <input type="password" name="old_password" id="" value=""><br>
            <label>New-Password</label>
            <input type="password" name="password" id="" value=""><br>
            <label>Enter the password</label>
            <input type="password" name="password_confirmation" id="" value="">
            <input type="submit" value="Lưu">
    </form>
@endsection
