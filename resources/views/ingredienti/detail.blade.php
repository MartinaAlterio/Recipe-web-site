@extends('template')

@section('content')
    @if(isset($inactive))

        <div class="error_message">L'ingrediente selezionato al momento non è attivo. </div>

    @else
    <div class="main_container main_container--ingredient">
        <div class="main_image main_image--ingredient" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')">
            <div class="sfondoProva"></div>
            <div class="main_title main_title--ingredient">{{$ingredient->name}}</div>
            <div class="sfondoProva"></div>
        </div>
    </div>

    <div>
        @foreach($ingredient->description as $description)
            <p>{{$description->description}}</p>
        @endforeach
    </div>

    @endif


@endsection
