<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MATERIALIZE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSS CUSTOM -->
    <link rel="stylesheet" href="{{ env('URL_HOST') }}/css/style.css">
    <link rel="shortcut icon" href="">
    <title>Cuentitas APP</title>
</head>
<body>
    @if ($_SERVER['REQUEST_URI'] != env('URL_HOST').'/login')
        @include('/generico/menu')
    @else
    <div></div>
    @endif
    <main>
        <h3 class="center-align">Cuentitas 📝 Team Pollitos 🐤</h3>