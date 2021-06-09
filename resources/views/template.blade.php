<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >

    <title>Title</title>
</head>
<body>
    <!--header-->
    <div class="header">
        <div class="logo">PAN&POMODORO</div>
        <div class="buttonContainer">
            <a href="/ricette" class="button">Ricette</a>
            <a href="/" class="button">Home</a>
            <a href="/ingredienti" class="button">Ingredienti</a>
        </div>
    </div>

    @yield('content')

    <!--footer-->
    <div>
        <h1>Questo è il footer!</h1>
    </div>
</body>
</html>
