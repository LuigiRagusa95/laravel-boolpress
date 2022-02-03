@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Elenco delle categorie</h1>
    @foreach ($categories as $category)
    <li><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
</div>
@endsection