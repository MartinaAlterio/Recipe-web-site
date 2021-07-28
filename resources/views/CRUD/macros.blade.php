@extends('templateDatabase')

@section('content')

    <form>
        Inserisci una nuova Macrocategoria
        <p>
        <label>
            Nome:
            <input type="text" name="name" value="">
        </label>
        <label>
            Url:
            <input type="text" name="url" value="">
        </label>
        <label>
            Image:
            <input type="text" name="image" value="">
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
            <label>
                Nome: <input type="text" name="name" value="{{$macro->name}}">
            </label>
            <label>
                Url: <input type="text" name="url" value="{{$macro->url}}">
            </label>
            <label>
                image: <input type="text" name="image" value="{{$macro->image}}">
            </label>
            <input type="hidden" name="id" value="{{$macro->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            <a href="/database/categorie?id={{$macro->id}}&&name={{$macro->name}}">Categorie</a>
            </p>
        </form>

    @endforeach

@endsection