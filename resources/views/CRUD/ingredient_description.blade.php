@extends('templateDatabase')

@section('content')

    <div>Aggiungi una descrizione per [{{$url}}] :</div>
    <form method="post">
        <label for="description">detail:
            <input id="description" type="text" name="description" value="">
        </label>
        <label for="image">image:
            <input id="image" type="text" name="image" value="">
        </label>
        <input type="hidden" name="url" value="{{$url}}">
        <input type="submit" name="action" value="insert">
        <a href="/database/ingredienti">Cancel</a>
        @csrf
    </form>
    <div>Descrizioni già salvate:</div>
    @foreach($descriptions as $description)
        <form method="post">
            <label for="description-{{$description->id}}">detail:
                <input id="description-{{$description->id}}" type="text" name="description" value="{{$description->description}}"></label>
            <label for="image-{{$description->id}}">image:
                <input id="image-{{$description->id}}" type="text" name="image" value="{{$description->image}}"></label>
            <input type="hidden" name="id" value="{{$description->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
             @csrf
        </form>

    @endforeach

@endsection
