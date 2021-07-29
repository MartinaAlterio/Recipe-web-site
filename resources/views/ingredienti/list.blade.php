@extends('template')

@section('content')
    <div class="main_container main_container--ingredients">
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredients->getUpTitle()['image'])}}')"></div>
        <div class="main_title main_title--ingredients">{{$ingredients->getTitle()['content']}}</div>
        <div class="main_image main_image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredients->getUnderTitle()['image'])}}')"></div>
        <div class="main_text main_text--ingredients"> {{$ingredients->getDescription()['content']}}</div>
    <div class="page_container">
        @foreach($list as $ingredient)
            <div class="main_content main_content--ingredients">
                <div class="main_content__image main_content__image--ingredients" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')">
                    <div class="title title--ingredients"><a href="/ingredienti/{{$ingredient->url}}">{{$ingredient->name}}</a></div>
                </div>
                    <div class="main_content__text main_content__text--ingredients">{{$ingredient->description}} </div>
                </div>
        @endforeach

@endsection


