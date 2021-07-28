@extends('template')

@section('content')
    @if(isset($message))
        @foreach($messages as $message)
            @if($message->type === 'success')
                <div class="success">{{$message}}</div>
            @elseif($message->type === 'error')
                <div class="error">{{$message}}</div>
            @endif
        @endforeach
    @endif

    <div class="main_container main_container--home" >
        <div class="main_image main_image--home" style="background-image: url('{{asset('storage/images/home/'.$home->getTitle()['image'])}}')"></div>
        <div class="main_title main_title--home">
            {{$home->getTitle()['content']}}
        </div>
        <div class="border border--home"></div>
        <div class="page_container page_container--home">
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->getRecipes()['image'])}}')"></div>
                <div class="main_content__text" >
                    <div class="text">{{$home->getRecipes()['content']}}</div>
                    <a href="/ricette">Scopri tutte le ricette</a>
                </div>
            </div>
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->getIngredients()['image'])}}')"></div>
                <div class="main_content__text" >
                    <div class="text"> {{$home->getIngredients()['content']}}</div>
                    <a href="/ingredienti">Impara a capire gli ingredienti</a>
                </div>
            </div>
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->getAboutMe()['image'])}}')"></div>
                <div class="main_content__text">
                    <div class="text"> {{$home->getAboutMe()['content']}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

