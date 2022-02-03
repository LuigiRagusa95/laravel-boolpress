@extends('layouts.app')

@section('content')
<div class="container">
    <p>Questa è la pagina riservata della categoria {{ $category->name}}</p>

    <div class="list-group">
        @forelse ($category->posts as $cat)
        <a href="{{ route('admin.posts.show', $cat->id) }}"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $cat->title }}</h5>
                <small>{{ $cat->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1">{{ $cat->text }}</p>
        </a>
        @empty
        <p>Nessun post in questa categoria</p>
        @endforelse
    </div>

</div>
@endsection