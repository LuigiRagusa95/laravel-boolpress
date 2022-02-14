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
                        <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"> Delete</button>
                        </form>
                    </span>
                </small>
                <div class="d-block mt-3">
                    <span><strong>Tags: </strong></span>
                    @if (!$post->tags->isEmpty())
                    @foreach ($post->tags as $tag)
                    <span class="badge bg-primary text-white">{{$tag->name}}</span>
                    @endforeach
                    @else <p>No tags for this post</p>
                    @endif
                </div>
                <div class="row mb-5">
                    <p class="{{ $post->cover ? 'col-md-6' : 'col' }}">{{ $post->text }}</p>
                    @if ($post->cover)
                        <div class="col md-6">
                            <img class="img-fluid" src="{{ asset('storage/'. $post->cover)}} " alt=" {{$post->title}} ">
                        </div>
                    @endif
                </div>
                <p class="d-flex mt-3">
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