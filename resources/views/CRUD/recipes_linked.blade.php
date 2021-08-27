@extends('templateDatabase')

@section('content')

    <div>Seleziona le ricette collegate a [{{$main_recipe->name}}]</div>
        <form method="post">
            @foreach($recipes as $recipe)
                <div class="element">
                    @if($recipe->id !== $main_recipe->id)
                        @if(in_array($recipe->id, $linked_recipes_id))
                            <input type="checkbox" name="id[]" value="{{$recipe->id}}" checked>
                        @else
                            <input type="checkbox" name="id[]" value="{{$recipe->id}}">
                        @endif
                        <p>{{$recipe->name}}</p><br>
                    @endif
                </div>
            @endforeach
            <input type="hidden" name="id_recipe" value="{{$main_recipe->id}}">
            <input type="hidden" name="url" value="{{$main_recipe->url}}">
            <input type="submit" name="action" value="insert">
            @csrf
        </form>

@endsection