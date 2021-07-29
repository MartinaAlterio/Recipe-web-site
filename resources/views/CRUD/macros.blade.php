@extends('templateDatabase')

@section('content')

    <form>
        Inserisci una nuova Macrocategoria
        <p>
        <label for="name">Nome:
            <input id="name" type="text" name="name" value="">
        </label>
        <label for="url">Url:
            <input id="url" type="text" name="url" value="">
        </label>
        <label for="image">Image:
            <input id="image" type="text" name="image" value="">
        </label>
        <input type="hidden" name="macro" value="1">
        <input type="submit" name="action" value="insert">
        </p>
    </form>

    Macrocategorie esistenti:
    @foreach($list as $macro)
        <form>
            <p>
            <p>-{{$macro->name}}</p>
            <label for="name-{{$macro->id}}">Nome:
                <input id="name-{{$macro->id}}" type="text" name="name" value="{{$macro->name}}">
            </label>
            <label for="url-{{$macro->id}}">Url:
                <input id="url-{{$macro->id}}" type="text" name="url" value="{{$macro->url}}">
            </label>
            <label for="image-{{$macro->id}}">image:
                <input id="image-{{$macro->id}}" type="text" name="image" value="{{$macro->image}}">
            </label>
            <input type="hidden" name="id" value="{{$macro->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            <a href="/database/categorie?id={{$macro->id}}&&name={{$macro->name}}">Categorie</a>
            </p>
        </form>

    @endforeach

@endsection