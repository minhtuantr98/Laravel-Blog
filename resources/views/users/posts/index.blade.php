@extends('layouts/app')

@section('content')
    <h3>{{ "Your Posts" }}</h3>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <a style="color:blue" href="/user/post/create">Create Post </a>
    @foreach ($posts as $value)
    <form action="/user/post/{{ $value->slug }}" method="post">
        {{method_field('DELETE')}}
        {{ csrf_field() }}
        <div id="category">
            <p>{{ $value->title }}</p>
            <input onclick="return confirm('Are u sure?')" type="submit" value="Delete">
            <a href="{{ '/user/post/'.$value->slug.'/edit' }}">Edit</a>
        </div>
    </form>
    @endforeach
    <div id="pagination">{!! $posts->links() !!}</div>
@endsection
