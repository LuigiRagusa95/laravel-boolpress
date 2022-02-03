@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post" autocomplete="off">
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
                <div class="mt-3"><button type="submit" class="btn btn-primary">Update</button></div>
            </form>
        </div>
    </div>
</div>
@endsection