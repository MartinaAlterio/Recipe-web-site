@extends('templateDatabase')

@section('content')

Inserimento ingredienti:
    <form method="post">
        <label for="name">Nome:</label>
        <input id="name" type="text" name="name" value="">
        Url:
        <input type="text" name="url" value="">
        Attivo:
        <input type="text" name="active" value="">
        <input type="submit" name="action" value="insert">
        <a href="/database/ingredienti">cancel</a>
        @csrf
    </form>
    Ingredienti inseriti:
    @if(empty($ingredients))
        <div class="empty_list">Nessun ingrediente disponibile.</div>
    @else
        @foreach($ingredients as $ingredient)
            <form method="post">
                <label for="name-{{$ingredient->id}}">Nome:</label>
                <input id="name-{{$ingredient->id}}"type="text" name="name" value="{{$ingredient->name}}">
                <label>Url:</label>
                <input type="text" name="url" value="{{$ingredient->url}}">
                Attivo:
                <input type="text" name="active" value="{{$ingredient->active}}">
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