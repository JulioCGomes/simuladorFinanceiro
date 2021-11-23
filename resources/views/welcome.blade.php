<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simulador Financiamento.</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/css/tailwindcss.css') }}">
        
        <style>
            body {
                margin: 0px;
                font-family: 'Nunito', sans-serif;
                background-image: url('/images/register_bg_2.png');
                background-color: #1e293b;
            }
        </style>
    </head>
    <body class="main">
        <div id="app">
            <!-- Conteúdo das minhas rotas. -->
            <router-view></router-view>
        </div>

        <script src="https://use.fontawesome.com/fbca0ff6a0.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
