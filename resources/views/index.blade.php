<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Weather app</title>
</head>
<body>
<div id="app">
    <app-index></app-index>
</div>
@vite('resources/js/app.js')
@vite('resources/scss/app.scss')
</body>
</html>





