@extends('layouts.app')

@section('content')
<div class="container">
    <p>Questa è la pagina riservata della categoria {{ $categories->name }}</p>
</div>
@endsection