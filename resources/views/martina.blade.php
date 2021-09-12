@extends('template')

@section('content')
    <div style="height: 200px;">

    </div>
    <div class="box box--green">
        <h1 class="box__title">Riccardo è antipatico</h1>
    </div>
    <div class="box box--blue">
        <h1 class="box__title">Riccardo è antipatico</h1>
    </div>
    <div style="height: 200px;">

    </div>
    <script>
        let boxBlue = document.querySelector('.box--blue');
        let boxGreen = document.querySelector('.box--green');
        let title = document.querySelector('.box--blue .box__title');

       // console.log(title);
        title.addEventListener('click', ()=> {
            boxGreen.classList.toggle('box--hidden');
        })
    </script>

@endsection
