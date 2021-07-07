@extends('template')

@section('content')
    <div class="main_container main_container--ingredients">
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/farine.jpg')}}')"></div>
        <div class="main_title main_title1">INGREDIENTI</div>
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/zuccheri.jpeg')}}')"></div>
    <div class="page_container">
            @foreach($list as $ingredient)
                <div class="main_content">
                    <div class="title"><a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a></div>
                    <div class="main_content__image" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')"> </div>
                    <div class="main_content__text"> </div>
                </div>
            @endforeach
        </div>
        <div>Collegamento alle ricette</div>
    </div>

@endsection


