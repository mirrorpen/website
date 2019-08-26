<!Doctype>
<html>
    <head>
        <title>@yield('title', 'lee\'s website')</title>
        <link rel="stylesheet" href="/css/app.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    @include('layouts._header')
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            @include('shared._messages')
            @yield('content')
            @include('layouts._footer')
        </div>
    </div>
    <script src="/js/app.js"></script>
    </body>
</html>