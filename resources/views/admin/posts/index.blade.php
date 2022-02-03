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
            <p class="mb-1">@if ($post->category) {{ $post->category->name }} @else Uncategorized @endif </p>
        </a>
        @endforeach
    </div>
    <div class="d-flex mt-3">{{ $posts->links() }}</div>
</div>
@endsection