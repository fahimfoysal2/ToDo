<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    <div id="app" class="mt-4">
{{--        {{dd($todos)}}--}}
        <todo-list :fetched-todos="{{$todos}}"></todo-list>
    </div>
</body>
</html>
