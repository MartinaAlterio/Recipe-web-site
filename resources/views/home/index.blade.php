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
    <br>
    <div class="main_container main_container--home" >
        <div class="main_image main_image--home" style="background-image: url('{{asset('storage/images/home/'.$home->title->image)}}')"></div>
        <div class="main_title main_title--home">
            {{$home->title->content}}
        </div>
        <div class="border border--home"></div>
        <div class="page_container page_container--home">
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->recipes->image)}}')"></div>
                <div class="main_content__text" >
                    <div class="text">{{$home->recipes->content}}</div>
                    <a href="/ricette">Scopri tutte le ricette</a>
                </div>
            </div>
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->ingredients->image)}}')"></div>
                <div class="main_content__text" >
                    <div class="text"> {{$home->ingredients->content}}</div>
                    <a href="/ingredienti">Impara a capire gli ingredienti</a>
                </div>
            </div>
            <div class="main_content main_content--home">
                <div class="main_content__image" style="background-image: url('{{asset('storage/images/home/'.$home->about_me->image)}}')"></div>
                <div class="main_content__text">
                    <div class="text"> {{$home->about_me->content}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

