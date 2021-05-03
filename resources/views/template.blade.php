<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >

    <title>Title</title>
</head>
<body>
    <!--header-->
    <div>
        <h1>Questo è l'header!</h1>
        <a href="/ricette">Ricette</a>
        <a href="/">Home</a>
        <a href="/ingredienti">Ingredienti</a>
    </div>

    @yield('content')

    <!--footer-->
    <div>
        <h1>Questo è il footer!</h1>
    </div>
</body>
</html>
