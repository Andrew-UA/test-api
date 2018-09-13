<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test-api</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- import CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        body {
            padding:  5px 5px 20px 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <!-- import JavaScript -->
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
