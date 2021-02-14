<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    </head>
    <body>
        <div><a href="{{ route('members.session.create') }}">Log in</a></div>
        <div><a href="{{ route('members.create') }}">Register</a></div>
        <form method="POST" action="{{ route('members.session.delete') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Log out</button>
        </form>
        <hr />
        @yield('content')
        @section('inline_js')
        @show
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
</html>
