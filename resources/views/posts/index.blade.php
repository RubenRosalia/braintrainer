@extends('layouts.posts')
@section('title', 'All Posts')

@section('content')
    <h1>All Posts</h1>
    <a href="/posts/create">+ New Post</a>
    @foreach ($posts as $post)

        <div>
            {{-- Display post id in url and display title on page.  --}}
            <h2><a href="/posts/{{ $post->id }}">{{ $post->title}}</a></h2>
            <p>By: {{ $post->author->name ?? 'Unknown'}}</p>
            {{-- Edit link. --}}
            <a href="/posts/{{ $post->id }}/edit">Edit</a>

            {{-- For deleting posts. --}}
            <form action="/posts/{{ $post->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
            </form>

        </div>
    @endforeach
@endsection
