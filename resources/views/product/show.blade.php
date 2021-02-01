@extends('layouts.app')

@section('content')
    <h1>產品頁</h1>
    <img width="400" src="{{ $product['imageUrl'] }}" alt="fruit image">
@endsection

@section('inline_js')
    @parent
@endsection