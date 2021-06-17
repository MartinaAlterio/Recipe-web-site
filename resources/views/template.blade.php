<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Playfair+Display&display=swap" rel="stylesheet">

    <title>Title</title>
</head>
<body>
    <!--header-->
    <div class="header">
        <div class="logo">Pan&Pomodoro</div>
        <div class="buttonContainer">
            <a href="/ricette" class="button">Ricette</a>
            <a href="/" class="button">Home</a>
            <a href="/ingredienti" class="button">Ingredienti</a>
        </div>
    </div>

    @yield('content')

    <!--footer-->
    <div class="footer">
        <h1>Questo è il footer!</h1>
    </div>
</body>
</html>
