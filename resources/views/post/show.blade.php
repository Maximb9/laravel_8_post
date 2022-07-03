@extends('layouts.main')
@section('content')
    <div>
            <div>{{ $post->id }}. {{ $post->title }}</div>
            <div>{{ $post->content }}</div>
    </div>
    <div>
        <a class="text-white btn btn-dark mt-3" href="{{ route('post.edit', $post->id) }}">Edit</a>
    </div>
    <div>
        <form action="{{ route('post.delete', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="text-white btn btn-secondary mt-3" value="Delete">
        </form>
    </div>
    <div>
        <a class="text-white btn btn-danger mt-3" href="{{ route('post.index') }}">Back</a>
    </div>
@endsection

