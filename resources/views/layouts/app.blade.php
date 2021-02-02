<html>
    <head>
        <title>購物車</title>
        @include('layouts.meta')
        @include('layouts.css')
    </head>
    <body>
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')
        @include('layouts.js')

        @section('inline_js')
        @show
    </body>
</html>