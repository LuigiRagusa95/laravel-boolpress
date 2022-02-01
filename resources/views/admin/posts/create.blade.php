@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="mb-1">
                    <label class="form-label" for="title"></label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="text"></label>
                    <textarea class="form-control" name="text" id="text">{{ old('text') }}</textarea>
                    @error('text')
                    <div class="d-flex text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3"><button type="submit" class="btn btn-primary">Create</button></div>
            </form>
        </div>
    </div>
</div>
@endsection