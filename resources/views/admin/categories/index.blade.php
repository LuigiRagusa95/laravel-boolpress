@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Elenco delle categorie</h1>
    @foreach ($categories as $category)
    <li>{{ $category->name }}</li>
    @endforeach
</div>
@endsection