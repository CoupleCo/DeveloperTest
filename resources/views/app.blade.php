<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dev Test</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            <div class="mx-auto">
                <header class="p-6 bg-purple-darker">
                    <a href="/app"><h2 class="text-white">Dev Test</h2></a>
                </header>
                <main class="contain py-4">
                    <router-view></router-view>
                </main>
                
            </div>
        </div>

    <script type="text/javascript" src="{{ mix('js/app.js')}}"></script>

    </body>
</html>
