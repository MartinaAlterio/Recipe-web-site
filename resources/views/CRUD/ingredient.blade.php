@extends('templateDatabase')

@section('content')

    <div>Inserimento ingredienti:</div>
        <form method="post">
            <label for="name">Nome:
                <input id="name" type="text" name="name" value="">
            </label>
            <label for="url">Url:
                <input id="url" type="text" name="url" value="">
            </label>
            <label for="active">Attivo:
                <input id="active" type="text" name="active" value="">
            </label>
            <input type="submit" name="action" value="insert">
            <a href="/database/ingredienti">cancel</a>
            @csrf
        </form>
    <div>Ingredienti inseriti:</div>
        @if(empty($ingredients))
            <div class="empty_list">Nessun ingrediente disponibile.</div>
        @else
            @foreach($ingredients as $ingredient)
                <form method="post">
                    <label for="name-{{$ingredient->id}}">Nome:
                        <input id="name-{{$ingredient->id}}"type="text" name="name" value="{{$ingredient->name}}">
                    </label>
                    <label for="url-{{$ingredient->id}}">Url:
                        <input id="url-{{$ingredient->id}}" type="text" name="url" value="{{$ingredient->url}}">
                    </label>
                    <label for="active-{{$ingredient->id}}">Attivo:
                        <input id="active-{{$ingredient->id}}" type="text" name="active" value="{{$ingredient->active}}">
                    </label>
                    <input type="hidden" name="id" value="{{$ingredient->id}}">
                    <input type="submit" name="action" value="update">
                    <input type="submit" name="action" value="delete">
                    @if($ingredient->active === 1)
                        <a href="/database/ingredienti/{{$ingredient->url}}">Detail</a>
                    @endif
                    @csrf
                </form>
            @endforeach
        @endif

@endsection