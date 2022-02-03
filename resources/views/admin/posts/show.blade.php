@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <article class="blog p-4">
                <h1 class="mb-0">{{ $post->title }}</h1>
                <small class="d-flex align-items-center">
                    <span class="position-relative">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="position-relative mb-2 mx-1 font-weight-bold">.</span>
                    <span class="d-flex position-relative">
                        <a class="link" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    </span>
                </small>
                <p class="flex mt-3">{{ $post->text }}</p>
                <p class="flex mt-3">
                    @if ($post->category_id)
                    <a class href="{{ route('admin.categories.show', $post->category->id) }}">{{$post->category->name
                        }}</a>
                    @else
                    Uncategorized
                    @endif
                </p>
            </article>
        </div>
    </div>
</div>
@endsection