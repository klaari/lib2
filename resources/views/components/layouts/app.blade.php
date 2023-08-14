<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Lib2' }}</title>
        <style>
            input {
                padding:8px;
                font-size: 24px;
                width: 450px;
            }
        </style>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
