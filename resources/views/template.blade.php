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
    <div class="container_header {{!empty($header_transparent) ? 'header_home': ''}}">
        <div class="header">
            <div> <a href="/" class="logo">Pan&Pomodoro</a> </div>
            <div class="buttonContainer">
                <a href="/ricette" class="button">Ricette</a>
                <a href="/ingredienti" class="button">Ingredienti</a>
            </div>
        </div>
    </div>

    @yield('content')

    <!--footer-->
    <div class="container_footer">
        <div class="footer">Questo è il footer!</div>
    </div>
</body>
</html>
