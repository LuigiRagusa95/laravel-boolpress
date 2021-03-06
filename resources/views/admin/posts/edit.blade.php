@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-1">
                    <label class="form-label" for="title"></label>
                    <input class="form-control" type="text" name="title" id="title"
                        value="{{ old('title', $post->title) }}">
                    @error('title')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="text"></label>
                    <textarea class="form-control" name="text" id="text">{{ old('text', $post->text) }}</textarea>
                    @error('text')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="category_id"></label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Uncategorized</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id',
                            $post->category_id)) selected @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]" id="tag-{{$loop->iteration}}" value="{{$tag->id}}"
                            @if($errors->any() && in_array($tag->id, old('tags')))
                        checked
                        @elseif(!$errors->any() && $post->tags->contains($tag->id))
                        checked
                        @endif
                        />
                        <label for="tag-{{$loop->iteration}}">{{ $tag->name }}</label>
                    </span>
                    @endforeach
                </div>
                <div class="mb-1">
                    @if ($post->cover)
                    <img width="300px" class="img-fluid mb-3" src="{{asset('storage/'.$post->cover)}}" alt="{{$post->title}}">
                    @endif
                    <label class="form-label" for="cover"></label>
                    <input class="form-control" type="file" name="cover" id="cover">
                    @error('cover')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
@endsection