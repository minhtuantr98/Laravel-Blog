@extends('layouts/app')

@section('content')

    <form action="/user/post" method="post">
        {{ csrf_field() }}

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <label>Title Post</label>
        <input type="text" name="title" id="title" value=""><br>
        <label>Content Post</label>
        <textarea class="form-control" id="summary-ckeditor" name="content"></textarea>
        <label>Category</label>
        <select name="category">
            @foreach ($categories as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select><br>   
        <input type="submit" value="Create">
    </form>
@endsection
