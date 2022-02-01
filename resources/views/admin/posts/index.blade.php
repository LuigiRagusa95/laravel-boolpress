@extends('layouts.app')

@section('content')
<div class="container">
    <div class="list-group">
        @foreach ($posts as $post)
        <a href="{{ route('admin.posts.show', $post->id) }}"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $post->title }}</h5>
                <small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1">{{ $post->text }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection