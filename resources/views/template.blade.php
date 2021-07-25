<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700&family=Playfair+Display&display=swap" rel="stylesheet">
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
    @if(!empty($messages))
        <div class="flash_messages">
            @foreach($messages as $message)
                @if($message['type'] === 'error')
                    <div class=" flash_message flash_message--error">{{$message['text']}}</div>
                @elseif($message['type'] === 'success')
                    <div class="flash_message flash_message--success">{{$message['text']}}</div>
                @endif
            @endforeach
        </div>
    @endif
    @yield('content')
    <!--footer-->
    <div class="container_footer">
        <div class="footer">
            <div class="contacts">
                <div>Contatti</div>
                <div>riccardo123puzza@losappiamo.com</div>
            </div>
            <div class="social">
                <div>Social</div>
                <div>
                    <p>instagram: <a href="instagram.com">RichiPuzzolone100</a></p>
                    <p>facebook: <a href="facebook.com">Vihogiàdetto Chepuzzo</a> </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        let header = document.querySelector('.header_home');
        if(header != null) {
            let over = false;
            window.addEventListener('scroll', () => {
                if(over === false && window.scrollY > header.scrollHeight ) {
                    header.classList.add("over_header");
                    over = true;
                } else if (over === true && window.scrollY < header.scrollHeight) {
                    header.classList.remove("over_header");
                    over = false;
                }
            })
        }
    </script>
</body>
</html>
