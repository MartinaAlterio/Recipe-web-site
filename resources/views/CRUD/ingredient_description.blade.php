@extends('templateDatabase')

@section('content')

    Aggiungi una descrizione per [{{$url}}] :
    <form method="post">
        <label>detail: <input type="text" name="description" value=""></label>
        <label>image: <input type="text" name="image" value=""></label>
        <input type="hidden" name="url" value="{{$url}}">
        <input type="submit" name="action" value="insert">
        <a href="/database/ingredienti">Cancel</a>
        @csrf
    </form>
    Descrizioni già salvate:
    @foreach($descriptions as $value)
        <form method="post">
            <label>detail: <input type="text" name="description" value="{{$value->description}}"></label>
            <label>image: <input type="text" name="image" value="{{$value->image}}"></label>
            <input type="hidden" name="id" value="{{$value->id}}">
            <input type="submit" name="action" value="update">
            <input type="submit" name="action" value="delete">
             @csrf
        </form>

    @endforeach

@endsection
