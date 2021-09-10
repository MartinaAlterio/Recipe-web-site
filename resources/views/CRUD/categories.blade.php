@extends('templateDatabase')

@section('content')
    <div>Inserisci una nuova categoria</div>
    <br>
    <form method="post">
        <label for="name">Nome:
            <input id="name" type="text" name="name" value="">
        </label>
        <label for="url">Url:
            <input id="url" type="text" name="url" value="">
        </label>
        <label for="macro">Macro:
            <input id="macro" type="text" name="macro" value="">
        </label>
        <label for="image">Immagine:
            <input id="image" type="text" name="image" value="">
        </label>
        <label for="description">Descrizione:
            <input id="description" type="text" name="description" value="">
        </label>
        <input type="submit" name="action" value="insert">
        <a href="/database/categorie">Cancel</a>
        @csrf
    </form>
    <br>
    <div>Categorie esistenti</div>
    <br>
    @foreach($categories as $category)
        <form method="post">
            <label for="name-{{$category->id}}">Name:
                <input id="name-{{$category->id}}" type="text" name="name" value="{{$category->name}}">
            </label>
            <label for="url-{{$category->id}}">Url:
                <input id="url-{{$category->id}}" type="text" name="url" value="{{$category->url}}">
            </label>
            <label for="macro--{{$category->id}}">Macro:
                <input id="macro--{{$category->id}}" type="text" name="macro" value="{{$category->macro}}">
            </label>
            <label for="image-{{$category->id}}">Immagine:
                <input id="image-{{$category->id}}" type="text" name="image" value="{{$category->image}}">
            </label>
            <label for="description-{{$category->id}}">Descrizione:
                <input id="description-{{$category->id}}" type="text" name="description" value="{{$category->description}}">
            </label>
            <input type="hidden" name="id" value="{{$category->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            @if($category->macro === 1)
                <a href="/database/categorie/collegamenti/{{$category->url}}">Collegamenti</a>
            @else
                <a href="/database/categorie/ricette/{{$category->url}}">Ricette</a>
            @endif
            @csrf
        </form>
        <br>
    @endforeach
@endsection
