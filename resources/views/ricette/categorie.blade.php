@extends('template')

@section('content')
    <div> foto ad effetto
         <h1>Qui trovi l'elenco completo delle mie ricette!</h1>
    </div>

    <div>
        <br>
        @if(isset($list))
            @foreach($list as $value)
                <h1>{{$value->name}}</h1> <br>
                @foreach($value->categories as $value)
                    <p>-    {{$value->name}}</p> <br>
                    @foreach($value->recipes as $value)
                        <p>*    {{$value->name}}</p> <br>
                    @endforeach
                @endforeach
                <p>--------------</p>
            @endforeach
        @endif
    </div>
@endsection


