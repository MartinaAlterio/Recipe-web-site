@extends('template')

@section('content')
    <div> foto ad effetto
         <h1>Qui trovi l'elenco completo delle mie ricette!</h1> <br>
    </div>

        @if(isset($macros))
            <ul>
                @foreach($macros as $value)

                    <li>{{$value->name}}</li>
                    @foreach($value->categories as $value)
                        <li><a href="/ricette/{{$value->url}}">{{$value->name}}</a></li>
                        @foreach($value->recipes as $recipe)
                               <li><a href="/ricette/{{$value->url}}/{{$recipe->url}}">{{$recipe->name}}</a></li>
                        @endforeach
                    @endforeach

                @endforeach

            </ul>


        @endif
@endsection


