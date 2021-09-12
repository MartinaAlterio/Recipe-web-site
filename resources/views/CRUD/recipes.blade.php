@extends('templateDatabase')

@section('content')

    <div>Inserisci una nuova Ricetta</div>
    <form method="post">
        <p>
            <label for="name">Nome:
                <input id="name" type="text" name="name" value="">
            </label>
            <label for="url">Url:
                <input id="url" type="text" name="url" value="">
            </label>
            <label for="subheading">Subheading:
                <input id="subheading" type="text" name="subheading" value="">
            </label>
            <label for="image">Image:
                <input id="image" type="text" name="image" value="">
            </label>
            <label for="active">Active:
                <input id="active" type="text" name="active" value="">
            </label>
            <input type="submit" name="action" value="insert">
            <a href="/database/ricette">cancel</a>
        </p>
        @csrf
    </form>

    <div>Ricette Inserite:</div>
    @foreach($recipes as $recipe)
        <form method="post">
            <label for="name-{{$recipe->id}}">Nome:
                <input id="name-{{$recipe->id}}" type="text" name="name" value="{{$recipe->name}}">
            </label>
            <label for="url-{{$recipe->id}}">Url:
                <input id="url-{{$recipe->id}}" type="text" name="url" value="{{$recipe->url}}">
            </label>
            <label for="subheading-{{$recipe->id}}">Subheading:
                <input id="subheading-{{$recipe->id}}" type="text" name="subheading" value="{{$recipe->subheading}}">
            </label>
            <label for="image-{{$recipe->id}}">Image:
                <input id="image-{{$recipe->id}}" type="text" name="image" value="{{$recipe->image}}">
            </label>
            <label for="active-{{$recipe->id}}">Active:
                <input id="active-{{$recipe->id}}" type="text" name="active" value="{{$recipe->active}}">
            </label>
            <input type="hidden" name="id" value="{{$recipe->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            <a href="/database/{{$recipe->url}}/ingredienti">Ingredienti</a>
            <a href="/database/{{$recipe->url}}/procedimenti">Procedimenti</a>
            <a href="/database/{{$recipe->url}}/collegamenti">Collegamenti</a>
            @csrf
        </form>
    @endforeach

@endsection
