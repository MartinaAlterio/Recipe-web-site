@extends('template')

@section('content')
    <div class="main_container main_container--macro">
        <div class="page_container page_container--macro">
            @if($macros === null)
                <div>Al momento non vi sono categorie da mostrare.</div>
            @else
                @foreach($macros as $macro)
                    <div class="main_content main_content--macro">
                        <div class="main_content__image main_content__image--macro" style="background-image: url('{{asset('storage/images/recipes/macro/'.$macro->image)}}')">
                            <div class="title title--macro">{{$macro->name}}</div>
                        </div>
                        <div class="container_list container_list--macro">
                            <div class="list list--macro">
                                @if(isset($error))
                                    <div>L'elenco delle caterie è momentaneamente non disponobile</div>
                                @else
                                    @foreach($macro->categories as $category)
                                        <div class="list__element">
                                            <div class="list__title list__title--macro"><a href="/ricette/{{$category->url}}">{{$category->name}}</a></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection


