@extends('templateDatabase')

@section('content')

    <div> Aggiungi procedimento e immagine per [{{$recipe->name}}]</div>
    <br>
    <form method="post">
        <label>
            Procedimento: <input type="text" name="method" value="">
        </label>
        <label>
            Immagine: <input type="text" name="image" value="">
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
    @foreach($methods as $value)
        <form method="post">
            <label>
                Procedimento: <input type="text" name="method" value="{{$value->method}}">
            </label>
            <label>
                Immagine: <input type="text" name="image" value="{{$value->image}}">
            </label>
            <input type="hidden" name="id" value="{{$value->id}}">
            <input type="hidden" name="url" value="{{$recipe->url}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
            @csrf
        </form>
        <br>
    @endforeach

@endsection