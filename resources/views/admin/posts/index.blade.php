@extends('layouts.app')

@section('content')
<div class="container">
    <div class="list-group">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary mb-3" href="{{ route('admin.posts.create') }}">Add New</a>
        </div>
        @foreach ($posts as $post)
        <a href="{{ route('admin.posts.show', $post->id) }}"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $post->title }}</h5>
                <small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1">{{ $post->text }}</p>
            <p class="m-0 mt-1">
                <strong>Category: </strong>
                @if ($post->category) {{ $post->category->name }} @else Uncategorized @endif
            </p>
            <div class="d-block mt-1">
                <span><strong>Tags: </strong></span>
                @if (!$post->tags->isEmpty())
                @foreach ($post->tags as $tag)
                <span class="badge bg-primary text-white">{{$tag->name}}</span>
                @endforeach
                @else <span>No tags for this post</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>
    <div class="d-flex mt-3">{{ $posts->links() }}</div>
</div>
@endsection