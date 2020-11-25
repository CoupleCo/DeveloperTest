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
            <div class="container mx-auto">
                <header class="py-6">
                    Dev Test
                </header>
                <main class="flex">
                    <aside class="w-1/5">
                        SideBar
                    </aside>
                    <div class="primary flex-1">
                        <router-view></router-view>
                    </div>
                </main>
                
            </div>
        </div>

    <script type="text/javascript" src="{{ mix('js/app.js')}}"></script>

    </body>
</html>
