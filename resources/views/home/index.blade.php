@extends('template')

@section('content')
    <div class="pageContainer home_page" >
        <div class="titleContainer home_title" style="background-image: url('{{asset('storage/images/recipes/'.$home->title->image)}}')"></div>
        <div class="subject home_subject">
            {{$home->title->content}}
        </div>
        <div class="border home_border"></div>
        <div class="textContainer">
            <div class="text_image">
                <div>{{$home->recipes->content}}</div>
                <div style="background-image: url('{{asset('storage/images/recipes/'.$home->recipes->image)}}')"></div>
            </div>
            <div class="text_image">
                <div>{{$home->ingredients->content}}</div>
                <div style="background-image: url('{{asset('storage/images/recipes/'.$home->ingredients->image)}}')"></div>
            </div>
            <div class="text_image">
                <div>{{$home->about_me->content}}</div>
                <div style="background-image: url('{{asset('storage/images/recipes/'.$home->about_me->image)}}')"></div>
            </div>
        </div>
    </div>
@endsection

