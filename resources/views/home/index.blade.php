<div class="home">
    @extends('template')

    @section('content')
        <div class="pageContainer home_page" >
            <div class="titleContainer home_title" style="background-image: url('{{asset('storage/images/recipes/'.$home->title->image)}}')"></div>
            <div class="subject home_subject">
                {{$home->title->content}}
            </div>
            <div class="border home_border"></div>
            <div class="textContainer">
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
</div>


<!--bisogna rivedere l'idea immagine+testo per la schermata home.Creazione di serie di immagini che si susseguono dinamicamente.
voglio modificare l'header nella home?
voglio splittare la scritta tra top e bot dell'immagine?
voglio una sola immagine?
voglio la home altrettanto pulita?-->
