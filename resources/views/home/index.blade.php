@extends('index')

@section('content')
<form action="" method="get" role="search" >
    {{ csrf_field() }}
   <div class="input-group">
        <input type="text" placeholder="Search...." name="search">
        <button type="submit" class="btn btn-primary">Search</button>
   </div>
</form>
@if (count($posts) == 0)
    {!! '<b> Can not found any match with your search!' !!}
@else
@foreach ($posts as $value)
<a href="{{ $value->locale.'/'.$value->slug }}">
    <div class="card ml-4" style="width:700px">
        <div class="card-body">
            <h3>{{ $value->title }}</h3>
        </div>
    </div>
</a>
@endforeach
<div id="pagination">{!! $posts->links() !!}</div>
@endif
@endsection
