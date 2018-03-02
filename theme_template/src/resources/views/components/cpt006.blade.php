<div class="cpt006 row">
    @if(isset($imageLeft))
        <div class="cpt006__img col-sm-12 col-lg-7"></div>
    @endif
    <div class="cpt006__text @if(isset($extraClasses)) {{ $extraClasses }} @endif">
        <p class="cpt006__tag karla--white karla--e7"> {{ $tag }} </p>
        <h1 class="cpt006__title karla--white karla--e3"> {!! $title !!} </h1>
        <p class="cpt006__paragraph playfair--white playfair--e10"> {{ $paragraph }} </p>
    </div>
    @if(isset($imageRight))
        <div class="cpt006__img cpt006__img--border-sponsor col-sm-12 col-lg-7"></div>
    @endif
</div>