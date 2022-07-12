@extends('layouts.main')
@section('content')
    <div>
        <div>
            <a class="text-white mb-3 btn btn-success" href="{{ route('post.create') }}">Add One</a>
        </div>
        @foreach($posts as $post)
            <div><a href="{{ route('post.show', $post->id) }}">{{ $post->id }}.{{ $post->title }}</a></div>
        @endforeach
        <div class="mt-3">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>

@endsection

