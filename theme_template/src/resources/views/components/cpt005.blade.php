<div class="cpt005-item">
    <a href="{{$url}}">
        {!! $image !!}
        <div class="inner__color-box @if(isset($coloredCarouselBox)) {{ $coloredCarouselBox }} @endif" style="@if(isset($backgroundColor)) background-color: {{ $backgroundColor }}; @endif">
            <div class="cpt005-prev"> <</div>
            <p class="karla karla--white karla--e7"> {!! $tag !!} </p>
            <h1 class="karla karla--white karla--e3"> {{ $title }} </h1>
            <p class="playfair playfair--white playfair--e10 d-none d-sm-none d-md-block"> {{ $paragraph }} </p>
            <div class="cpt005-next"> ></div>
        </div>
    </a>
</div>



