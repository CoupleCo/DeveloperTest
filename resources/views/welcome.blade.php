<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">

            <div>

                <example-component></example-component>

                <passport-clients></passport-clients>

                <passport-authorized-clients></passport-authorized-clients>

                <passport-personal-access-tokens></passport-personal-access-tokens>

            </div>
        </div>

    <script type="text/javascript" src="{{ mix('js/app.js')}}"></script>

    </body>
</html>
