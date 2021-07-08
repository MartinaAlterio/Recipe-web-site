@extends('template')

@section('content')
    <div class="main_container main_container--ingredients">
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredients->upTitle->image)}}')"></div>
        <div class="main_title main_title--ingredients">INGREDIENTI</div>
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredients->underTitle->image)}}')"></div>
        <div class="main_text"> </div>
    <div class="page_container">
            @foreach($list as $ingredient)
                <div class="main_content main_content--ingredients">
                    <div class="main_content__image main_content__image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')">
                        <div class="title title--ingredients"><a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a></div>
                    </div>
                    <div class="main_content__text"> </div>
                </div>
            @endforeach
        </div>
        <div>Collegamento alle ricette</div>
    </div>

@endsection


