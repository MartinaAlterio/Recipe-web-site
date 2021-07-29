@extends('templateDatabase')

@section('content')

    <div> Aggiungi procedimento e immagine per [{{$recipe->name}}]</div>
    <br>
    <form method="post">
        <label for="method">Procedimento:
            <input id="method" type="text" name="method" value="">
        </label>
        <label for="image">Immagine:
            <input id="image" type="text" name="image" value="">
        </label>
        <input type="hidden" name="id_recipe" value="{{$recipe->id}}">
        <input type="hidden" name="url" value="{{$recipe->url}}">
        <input type="submit" name="action" value="insert">
        <a href="/database/{{$recipe->url}}/procedimenti">Cancel</a>
        @csrf
    </form>
    <br>
    <div>Procedimenti esistenti per [{{$recipe->name}}]</div>
    <br>
    @foreach($methods as $method)
        <form method="post">
            <label for="method-{{$method->id}}">Procedimento:
                <input id="method-{{$method->id}}" type="text" name="method" value="{{$method->method}}">
            </label>
            <label for="image-{{$method->id}}">Immagine:
                <input id="image-{{$method->id}}" type="text" name="image" value="{{$method->image}}">
            </label>
            <input type="hidden" name="id" value="{{$method->id}}">
            <input type="hidden" name="url" value="{{$recipe->url}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            @csrf
        </form>
        <br>
    @endforeach

@endsection