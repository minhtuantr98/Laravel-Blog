@extends('index')

@section('content')
        <h2>{{ $category->name }}</h2>
        @foreach ($posts as $value)
            <a href="{{ '/'.$value->locale.'/'.$value->slug }}">
                <div class="card ml-4" style="width:700px">
                    <div class="card-body" >
                        <h3>{{ $value->title }}</h3>

                    </div>
                </div>
            </a>
        @endforeach
        <div id="pagination">{!! $posts->links() !!}</div>
@endsection
