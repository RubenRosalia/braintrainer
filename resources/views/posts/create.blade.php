@extends('layouts.posts')
@section('title', 'New Post')

@section('content')
    <h1>Create a Post</h1>
    
    <form action="/posts" method="POST">
        @csrf

        @if ($errors->any())
            <ul style="color:red">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div>
            <label>Title</label>
            <input type="text" name="title">
        </div>

        <div>
            <label>Body</label>
            <textarea name="body"></textarea>
        </div>

        <button type="submit">Save</button>
    </form>

    <a href="/posts">← Back</a>
@endsection
