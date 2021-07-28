@extends('templateDatabase')

@section('content')

Inserimento ingredienti:
    <form method="post">
        <p>Nome:
        <input type="text" name="name" value="">
        Url:
        <input type="text" name="url" value="">
        Attivo:
        <input type="text" name="active" value="">
        <input type="submit" name="action" value="insert">
        <a href="/database/ingredienti">cancel</a>
        </p>
        @csrf
    </form>
    Ingredienti inseriti:
    @foreach($ingredients as $ingredient)
    <form method="post">
        <p>Nome:
        <input type="text" name="name" value="{{$ingredient->name}}">
        Url:
        <input type="text" name="url" value="{{$ingredient->url}}">
        Attivo:
        <input type="text" name="active" value="{{$ingredient->active}}">
        <input type="hidden" name="id" value="{{$ingredient->id}}">
        <input type="submit" name="action" value="update">
        <input type="submit" name="action" value="delete">
            @if($ingredient->active === 1)
                <a href="/database/ingredienti/{{$ingredient->url}}">Detail</a>
            @endif</p>
        @csrf
    </form>
    @endforeach

@endsection