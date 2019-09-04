@extends('index')

@section('content')
    <h3>{{ $post->title }}</h3>
    {!! Markdown::convertToHtml($post->content) !!}
@endsection
