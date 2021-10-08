<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/mainData.css') }}" >
    <title>Title</title>
</head>
<body>
    @if(!empty($messages))
        <div class="flash_messages">
            @foreach($messages as $message)
                @if($message['type'] === 'error')
                    <div class=" flash_message flash_message--error">
                        {{$message['text']}}
                        <div class="closure">X</div>
                    </div>
                @elseif($message['type'] === 'success')
                    <div class="flash_message flash_message--success">
                        {{$message['text']}}
                        <div class="closure">X</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @yield('content')

<script>
    let flash_messages = document.querySelectorAll('.flash_message');
    flash_messages.forEach((flash_message)=> {
        flash_message.addEventListener('click', ()=> {
            flash_message.classList.add('closed');
        })
    })
</script>
</body>
</html>