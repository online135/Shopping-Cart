@extends('layouts.app')

@section('content')

<h1>Products Index Page</h1>
@foreach ($products as $product)
    <a href="{{ route('products.show', ['product' => $product['id'] ]) }}">
        <img width="400" src="{{ $product['imageUrl'] }}" alt="fruit image">
    </a>
    <br/>
@endforeach

@endsection

@section('inline_js')
    @parent
@endsection