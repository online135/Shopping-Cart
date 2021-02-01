@extends('layouts.app')

@section('content')
    <h1>測試</h1>
    <p>name: {{ $name }}</p>
    <p>version: {{ $version }}</p>
@endsection

@section('inline_js')
    @parent
@endsection