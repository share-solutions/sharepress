@if(isset($nutritionalTable['nutrientes']) && !!$nutritionalTable['nutrientes'])
    <div class="cpt015 @if(isset($extraClassesDesktop)) {{ $extraClassesDesktop }} @endif @if(isset($extraClassesMobile)) {{ $extraClassesMobile }} @endif">
        <h2 class="cpt015__title museo museo--e1">{{ $nutritionTitle }}</h2>
        <p class="cpt015__subtitle">{{ $nutritionalTable['header'] }}</p>
        <div class="cpt015__list">
            <ul class="cpt015__list-text">
                @foreach($nutritionalTable['nutrientes'] as $nutriente)
                    <li>{{$nutriente['nutriente']}}</li>
                @endforeach
            </ul>
            <ul class="cpt015__list-value">
                @foreach($nutritionalTable['nutrientes'] as $nutriente)
                    <li>{{$nutriente['valor']}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif