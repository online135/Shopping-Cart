@extends('layouts.app')

@section('content')
    <h1>Product Show Page</h1>
    <img width="400" src="{{ $product['imageUrl'] }}" alt="fruit image">
@endsection

@section('inline_js')
    @parent
@endsection