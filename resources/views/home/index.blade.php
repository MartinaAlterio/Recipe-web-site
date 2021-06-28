@extends('template')

@section('content')
    <div class="pageContainer homePage" >
        <div class="titleContainer home_title" style="background-image: url('{{asset('storage/images/recipes/'.$home->title->image)}}')"></div>
        <div class="subject">
            {{$home->title->content}}
        </div>
        <div class="border"></div>
        <div class="textContainer">
            <div class="text_image">
                <div class="image" style="background-image: url('{{asset('storage/images/recipes/'.$home->recipes->image)}}')"></div>
                <div class="text_link" >
                    <div class="text">{{$home->recipes->content}}</div>
                    <a href="/ricette">Scopri tutte le ricette</a>
                </div>
            </div>
            <div class="text_image">
                <div class="image" style="background-image: url('{{asset('storage/images/recipes/'.$home->ingredients->image)}}')"></div>
                <div class="text_link" >
                    <div class="text"> {{$home->ingredients->content}}</div>
                    <a href="/ingredienti">Impara a capire gli ingredienti</a>
                </div>
            </div>
            <div class="text_image ">
                <div class="image" style="background-image: url('{{asset('storage/images/recipes/'.$home->about_me->image)}}')"></div>
                <div class="text_link text">{{$home->about_me->content}}</div>
            </div>
        </div>
    </div>
@endsection

