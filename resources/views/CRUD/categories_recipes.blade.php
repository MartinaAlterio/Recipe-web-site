@extends('templateDatabase')

@section('content')

    <div>Seleziona le ricette per la categoria [{{$category->name}}]</div>

    <form method="post">
    @foreach($recipes as $recipe)
        <div class="element">
            @if(in_array($recipe->id, $id_recipes))
                <input type="checkbox" name="id[]" value="{{$recipe->id}}" checked>

            @else
                <input type="checkbox" name="id[]" value="{{$recipe->id}}">
            @endif
            <p>{{$recipe->name}}</p><br>
        </div>
    @endforeach
    <input type="hidden" name="id_category" value="{{$category->id}}">
    <input type="hidden" name="url" value="{{$category->url}}">
    <input type="submit" name="action" value="insert">
    @csrf
    </form>

@endsection