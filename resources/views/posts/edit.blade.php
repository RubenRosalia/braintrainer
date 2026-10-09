@extends('layouts.posts')
@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    {{-- Error check --}}
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>

        <div>
            <label>Body</label>
            <textarea name="body">{{ $post->body }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="/posts">← Back</a>
@endsection