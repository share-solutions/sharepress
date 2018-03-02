@if(isset($instructions) && !!$instructions)
    <h3 class="rec001-body__text-title playfair playfair--e9">{{ $instructionsTitle }}</h3>
    <div class="cpt013 rec001-body__text playfair playfair--e10">
        <ol>
            @foreach($instructions as $instruction)
                <li>
                    <p>{{ $instruction['instrucao'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
@endif