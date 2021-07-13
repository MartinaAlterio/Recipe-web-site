@extends('template')

@section('content')
    @if(isset($inactive))
        <div class="main_container main_container--error">
            <div class="error_message">
                L'ingrediente cercato al momento non è attivo.
                Torna alla sezione "Ingredienti".
            </div>
            <div class="main_image main_image--error" style="background-image: url('{{asset('storage/images/ingredients/farine.jpg')}}')">
                <div class="redirect"> <a href="/ingredienti">INGREDIENTI</a> </div>
            </div>
        </div>


    @else
    <div class="main_container main_container--ingredient">
        <div class="main_image main_image--ingredient" style="background-image: url('{{asset('storage/images/ingredients/'.$ingredient->image)}}')">
            <div class="sfondoProva"></div>
            <div class="main_title main_title--ingredient">{{$ingredient->name}}</div>
            <div class="sfondoProva"></div>
        </div>
    </div>

    <div class="main_content main_content--ingredient">
        @foreach($ingredient->description as $description)
            <div class="main_content__text main_content__text--ingredient">{{$description->description}}</div>
            <div class="main_content__image main_content__image--ingredient" style="background-image: url('{{asset('storage/image/ingredients/ingredient'.$description->image)}}')"></div>
        @endforeach
    </div>

    @endif


@endsection
