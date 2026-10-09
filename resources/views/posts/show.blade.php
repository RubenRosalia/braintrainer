@extends('layouts.posts')
@section('title', $post->title)
<p>this is one posts</p>
@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
<a href="/posts">← Back</a>
@endsection

