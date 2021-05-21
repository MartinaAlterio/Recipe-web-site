@extends('template')

@section('content')
    <div class="title">
        <div>
            {{$home->title->content}}
        </div>
        <div>
            {{$home->subtitle->content}}
        </div>
    </div>
    <div>
        <div>
            <div>{{$home->recipes->content}}</div>
            <div>{{$home->recipes->image}}</div>
        </div>
        <div>
            <div>{{$home->ingredients->content}}</div>
            <div>{{$home->ingredients->image}}</div>
        </div>
        <div>
            <div>{{$home->about_me->content}}</div>
            <div>{{$home->about_me->image}}</div>
        </div>
    </div>

@endsection
