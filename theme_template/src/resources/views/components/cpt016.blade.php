@if(isset($ingredients) && !!$ingredients)
    <div class="{{ $extraClasses }}">
        <h2 class="cpt016__title museo museo--e1">{{ $ingredientsTitle }}</h2>
        <ul class="cpt016__list">

            @foreach($ingredients as $ingredient)
                <li>{{$ingredient['ingredient']}}</li>
            @endforeach
        </ul>
    </div>
@endif