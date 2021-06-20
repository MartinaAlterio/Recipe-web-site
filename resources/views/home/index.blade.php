@extends('template')

@section('content')
    <div class="pageContainer">
        <div class="titleContainer" style="background-image: url('{{asset('storage/images/recipes/'.$home->title->image)}}')"></div>
        <div class="subject">
            {{$home->title->content}}
        </div>
        <div class="border"></div>
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
    </div>


@endsection

//bisogna rivedere l'idea immagine+testo per la schermata home.Creazione di serie di immagini che si susseguono dinamicamente.
//voglio modificare l'header nella home?
//voglio splittare la scritta tra top e bot dell'immagine?
//voglio una sola immagine?
//voglio la home altrettanto pulita?
